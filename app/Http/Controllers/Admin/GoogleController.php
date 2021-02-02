<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Student\StoreStudentDocumentRequest;
use App\Http\Requests\Employee\StoreEmployeeDocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Student;
use App\Employee;
use App\User;
use App\StudentDocument;
use App\StudentRequiredDocument;
use App\EmployeeDocument;
use App\EmployeeRequiredDocument;
use Auth;

class GoogleController extends MainController
{
        public $gClient;
        public function __construct(){
            $google_redirect_url = route('glogin');
            $this->gClient = new \Google_Client();
            $this->gClient->setApplicationName(config('services.google.app_name'));
            $this->gClient->setClientId(config('services.google.client_id'));
            $this->gClient->setClientSecret(config('services.google.client_secret'));
            $this->gClient->setRedirectUri($google_redirect_url);
            $this->gClient->setDeveloperKey(config('services.google.api_key'));
            $this->gClient->setScopes(array(               
                'https://www.googleapis.com/auth/drive.file',
                'https://www.googleapis.com/auth/drive'
            ));
            $this->gClient->setAccessType("offline");
            $this->gClient->setApprovalPrompt("force");
        }
        public function googleLogin(Request $request)  {
            
            $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);
            if ($request->get('code')){
                $this->gClient->authenticate($request->get('code'));
                $request->session()->put('token', $this->gClient->getAccessToken());
            }
            if ($request->session()->get('token'))
            {
                $this->gClient->setAccessToken($request->session()->get('token'));
            }
            if ($this->gClient->getAccessToken())
            {
                //For logged in user, get details from google using acces
                $user = User::find(Auth::user()->id);
                $user->access_token=json_encode($request->session()->get('token'));
                $user->save();               
                dd("Successfully authenticated");
            } else
            {
                //For Guest user, get google login url
                $authUrl = $this->gClient->createAuthUrl();
                return redirect()->to($authUrl);
            }
        }
        
        public function uploadFileUsingAccessToken(StoreStudentDocumentRequest $request){
            $service = new \Google_Service_Drive($this->gClient);
            $user = User::find(Auth::user()->id);
            $student = Student::find($request['id']);
            $this->gClient->setAccessToken(json_decode($user->access_token,true));
            if ($this->gClient->isAccessTokenExpired()) {
               
                // save refresh token to some variable
                $refreshTokenSaved = $this->gClient->getRefreshToken();
                // update access token
                $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);               
                // // pass access token to some variable
                $updatedAccessToken = $this->gClient->getAccessToken();
                // // append refresh token
                $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
                //Set the new acces token
                $this->gClient->setAccessToken($updatedAccessToken);
                
                $user->access_token=$updatedAccessToken;
                $user->save();                
            }
            
            $old = StudentDocument::where('document_id',$request['document_id'])
                    ->where('student_id',$request['id'])->first();
            if($old)
            return json_encode($this->respondWithError(trans('messages.old')));
            
            $file = $request->file('statement');
            $extension = $file->getClientOriginalExtension();
            $document = StudentRequiredDocument::find($request['document_id']);
            $fileName = $document->name .'-'. Str::random(5).'.'.$extension;
            
            $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => $student->name.' '.$student->middle_name.' '.$student->last_name,
                'mimeType' => 'application/vnd.google-apps.folder'));
            $folder = $service->files->create($fileMetadata, array(
                'fields' => 'id'));
            //printf("Folder ID: %s\n", $folder->id);
               
            
            $file = new \Google_Service_Drive_DriveFile(array(
                            'name' => $fileName,
                            'parents' => array($folder->id)
                        ));
            $result = $service->files->create($file, array(
              'data' => file_get_contents($request->file('statement')),
              'mimeType' => 'application/octet-stream',
              'uploadType' => 'media'
            ));
            // get url of uploaded file
            $url='https://drive.google.com/open?id='.$result->id;
            //dd($url);
            $doc = StudentDocument::create([
                'document_id' => $request['document_id'],
                'student_id' => $request['id'],
                'file' => $fileName,
                'url' => $url,
            ]);
            StudentDocument::where('id',$doc->id)->update([
                        'url' => $url,
            ]);
            //dd($result);
            return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
                'model' => class_basename(get_class(new StudentDocument))
            ])));
                
        }
        
        public function uploadEmloyeeFile(StoreEmployeeDocumentRequest $request){
            $service = new \Google_Service_Drive($this->gClient);
            $user = User::find(Auth::user()->id);
            $employee = Employee::find($request['id']);
            $this->gClient->setAccessToken(json_decode($user->access_token,true));
            if ($this->gClient->isAccessTokenExpired()) {
               
                // save refresh token to some variable
                $refreshTokenSaved = $this->gClient->getRefreshToken();
                // update access token
                $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);               
                // // pass access token to some variable
                $updatedAccessToken = $this->gClient->getAccessToken();
                // // append refresh token
                $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
                //Set the new acces token
                $this->gClient->setAccessToken($updatedAccessToken);
                
                $user->access_token=$updatedAccessToken;
                $user->save();                
            }
            
            $old = EmployeeDocument::where('document_id',$request['document_id'])
                    ->where('student_id',$request['id'])->first();
            if($old)
            return json_encode($this->respondWithError(trans('messages.old')));
            
            $file = $request->file('statement');
            $extension = $file->getClientOriginalExtension();
            $document = EmployeeRequiredDocument::find($request['document_id']);
            $fileName = $document->name .'-'. Str::random(5).'.'.$extension;
            
            $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => $employee->name.' '.$employee->middle_name.' '.$employee->last_name,
                'mimeType' => 'application/vnd.google-apps.folder'));
            $folder = $service->files->create($fileMetadata, array(
                'fields' => 'id'));
            //printf("Folder ID: %s\n", $folder->id);
               
            
            $file = new \Google_Service_Drive_DriveFile(array(
                            'name' => $fileName,
                            'parents' => array($folder->id)
                        ));
            $result = $service->files->create($file, array(
              'data' => file_get_contents($request->file('statement')),
              'mimeType' => 'application/octet-stream',
              'uploadType' => 'media'
            ));
            // get url of uploaded file
            $url='https://drive.google.com/open?id='.$result->id;
            //dd($url);
            $doc = EmployeeDocument::create([
                'document_id' => $request['document_id'],
                'employee_id' => $request['id'],
                'file' => $fileName,
                'url' => $url,
            ]);
            EmployeeDocument::where('id',$doc->id)->update([
                        'url' => $url,
            ]);
            //dd($result);
            return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
                'model' => class_basename(get_class(new EmployeeDocument))
            ])));
                
        }
}
@extends('admin.layouts.master')
@section('meta')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Med Troops">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Med Troops">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
@endsection
@section('title','Payment Plan')
@section('styles')
    <!-- vendor css -->
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">

    <!-- Med Troops CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
@endsection
@section('content')
        <div class="br-pagebody">
          <div class="br-section-wrapper" id="printableArea">
            <div class="form-layout form-layout-1">
              <div class="row" style="padding:20px;">
                <div class="col-md-12" style="text-align:center;">
                  <img src="{{asset('vendors/img/logo.png')}}" style="max-width: 260px;"><hr>
                  <h4 class="tx-gray-800 mg-b-5">Payment Plan</h4>
                </div>
                <div class="col-md-12">
                  <p> </p>
                </div>
                <div class="col-md-12">
                  <div class="bd rounded table-responsive">
                    <!--<p class="mg-b-0">Do big things with Med Troops, the responsive bootstrap 4 admin template.</p>-->
                    <table class="table table-bordered" style="padding-bottom: 0; margin-bottom: 0;">
                      <tbody>
                        <tr>
                          <th style="max-width:50px;">Name :</th>
                          <th>{{$student->name}} {{$student->middle_name}} {{$student->last_name}}</th>
                          <th style="max-width:50px;">Program :</th>
                          <th>@if($student->program_id != null) {{$student->program->name}} @elseif($student->diplom_id != null) {{$student->diplom->name}} @else   @endif</th>
                        </tr>
                        <tr>
                          <th style="max-width:50px;">Employer :</th>
                          <th>@if($student->corporate_id != null) {{$student->corporate->name}} @else  @endif</th>
                          <th style="max-width:50px;">Intake :</th>
                          <th>@if($student->intake_id != null) {{$student->intake->name}} @else  @endif</th>
                        </tr>
                        <tr>
                          <th style="max-width:50px;">Position :</th>
                          <th>@if($student->job != null) {{$student->job}} @else  @endif</th>
                          <th style="max-width:50px;">Mobile :</th>
                          <th>@if($student->mobile1 != null) {{$student->mobile1}} @else  @endif</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12">
                  <p> </p>
                </div>
                <div class="col-md-12">
                  <div class="bd rounded table-responsive">
                    <!--<p class="mg-b-0">Do big things with Med Troops, the responsive bootstrap 4 admin template.</p>-->
                    <table class="table table-bordered" style="padding-bottom: 0; margin-bottom: 0;">
                      <thead>
                        <tr>
                          <th>Tuition Fees</th>
                          <th>Amount in EGP</th>
                          <th>Amount in Euro</th>
                          <th>Amount in USD</th>
                          <th>Due Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($payments as $payment)
                          <tr>
                            <td>{{$payment->name}}</td>
                            <td>{{$payment->egp_amount}}</td>
                            <td>{{$payment->euro_amount}}</td>
                            <td>{{$payment->usd_amount}}</td>
                            <td>{{$payment->date}}</td>
                          </tr>
                        @endforeach
                          <tr>
                            @if($total_egp > 0)
                              <td>Total EGP : {{$total_egp}}</td>
                              <td> </td>
                            @endif
                            @if($total_euro > 0)
                              <td>Total Euro : {{$total_euro}}</td>
                              <td> </td>
                              <td> </td>
                            @endif
                            @if($total_usd > 0)
                              <td>Total USD : {{$total_usd}}</td>
                            @endif
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12">
                  <p> </p>
                </div>
                <div class="col-md-12" style="text-align:center;">
                  <hr><h6 class="tx-gray-800 mg-b-5">Academic Policy And Regulation </h6>
                </div>
                <div class="col-md-12">
                  <p> </p>
                </div>
                <div class="col-md-12">
                  <div class="bd rounded table-responsive">
                    <!--<p class="mg-b-0">Do big things with Med Troops, the responsive bootstrap 4 admin template.</p>-->
                    <table class="table table-bordered" style="padding-bottom: 0; margin-bottom: 0;">
                      <tbody>
                        <tr>
                          <td style="width: 500px;"><p><strong>Introduction:<br></strong>- Each participant at Rome Business School and Brilliance Business School is required, as a condition of enrollment, to comply with the academic policies and regulations hereunder. Participant is expected to get familiarized with provisions.
                            <br><strong>Registration Policy:<br></strong>
                            <ul>
                              <li>Participant must register in-person with his/her Career Advisor</li>
                              <li>Participants not officially enrolled in the program until full submission of all required admission documents, paid the registration fees and settle the first tuition fees</li>
                            </ul>
                            <br><strong>Course Attendance Policy (CAP):<br></strong>
                            <ul>
                              <li>Classes should begin on time as per communicated schedule. Attendance is recorded in class attendance form.</li>
                              <li>Participant must attend a minimum of 75% of the course to be eligible to get into the exam /submit the final project, otherwise considered as “failed”</li>
                              <li>Participants expected to attend all scheduled classes, examinations, class presentations, simulations, exercises, research and group work </li>
                              <li>Illness and other emergency circumstances that require necessitate absence from class should be reported through submitting an excusal form via email as promptly as possible to Student Affairs (SA).Unexplained absences count as a zero for that day’s class.</li>
                              <li>School may change the schedule upon change in circumstances may happen or in Professors’ plan with suitable prior notice. </li>
                              <li>It is always the participant’s own responsibility to review the all class material covered or referred to whether they are present or absent. The participant should consult with the professor regarding any part of coursework, examination or assignments.</li>
                            </ul>
                            <br><strong>Graduation Policy and Requirements<br></strong>
                            <ul>
                              <li>Participant must fulfill All the following requirements to be eligible to graduate and to be granted the degree:</li>
                              <ul>
                                <li>Has not received any “Incomplete” grades</li>
                                <li>Has no outstanding “Code of Conduct” issues</li>
                                <li>Has completed all the program courses</li>
                                <li>Has submitted his final thesis on the agreed deadline</li>
                                <li>Has paid the graduation fees equal to €250</li>
                              </ul>
                              <li>It is participant’s responsibility to make sure that all the above graduation requirements have been fulfilled</li>
                              <li>SA must be furnished with a list of all courses the participant has passed beside the thesis in order to submit in fulfillment of the program credits required for the degree.</li>
                              <li>SA must sign a final declaration form with financial clearance. Final certificate and final transcript will not be granted except after full settlement of all the financial obligations and any additional charges.</li>
                            </ul>
                            <br><strong>Payment Policy:<br></strong>The below information highlights the payment policy regarding the program financial issues:
                            <ul>
                              <li>Payments with be settled every 3 months as agreed in the payment plan, dates are calculated from the starting date of the program</li>
                              <li>It is the participant’s full responsibility to settle the payments on the agreed payment schedule as shown in this agreed payment plan. School has no obligation or any responsibility to remind the participant of the due payments. Participant must follow up and make sure that all payments are settled</li>
                              <li>Participant must settle their payments in advance (i.e. prior each semester) before participant get into the semester. Otherwise, Participant is not eligible to attend the class.</li>
                              <li>The program fees and payments have to be settled in absolute net amounts and by the agreed currencies amounts</li>
                              <li>Late Payment policy is as follows:</li>
                              <ul>
                                <li>Participant will be given maximum 7 days (including weekends) as grace period after due date to settle the payment</li>
                                <li>If the payment is still unsettled after these 7 days, payment is subject to 10% late charge fees that must be paid with the late payment in another 7 days after the grace period. Participant’s grade and transcripts will be obscured</li>
                                <li>If payment is still unpaid after this period (with the late charge fees), the school retains its right to suspend participant from the program results in not allowing the participant to resume his/her class or undertake the exam unless the full payment is settled plus €80 reactivation charge with maximum 10 days.</li>
                                <li>If payment is still unpaid, participant will be dismissed from the program and must to reregister again as a new candidate</li>
                              </ul>
                              
                            </ul>
                          </p></td>
                          <td style="width: 500px;"><p><strong>Program Policy:<br></strong>
                            <ul>
                              <li>Participant must complete MBA in maximum period of 18 months from the starting date of the program. School has no obligations or any responsibility towards the participant after that period. Participant has to register again from the start with new fees.</li>
                              <li>In case of freezing (maximum 6 months) the program upon participant’s request, a “Temporary withdrawal Form” has to be submitted to the SA. When resuming the program, participant should send to the SA to resume the program and reschedule with suitable group with €80 charge that will be paid before starting</li>
                            </ul>
                            <br><strong>Examination and Assignment Policy:<br></strong>
                            <ul>
                              <li>Professors will announce their examination approach in the course. Participants must take examinations as scheduled. </li>
                              <li>No Show in final exam without writing approval excuse, participant will be considered "failed" in this course and must re-attend the course with full payment.</li>
                              <li>Make-up Exam: In unavoidable situations such as relative death, medical or serious personal emergencies, (documentation needed), participant has to send an email to SA to reschedule a make-up exam within 7 days maximum (including weekends) from the date of the original exam with a standard charge of €30. In case of participant missed 7 days without undertaking the make-up exam or “no show”, participant is considered “failed” in this course and must attend the course again with full payment.</li>
                              <li>In case of not passing the exam, participant must arrange to undertake another exam within 21 days from the exam original date with €80 reexamination charge. In case of failing the exam, participant must take and pay course again</li>
                              <li>Rechecking exam paper request is charged €30 </li>
                            </ul>
                            <br><strong>Discounts / Late Payment Policy </strong>(for Individual/Corporate)<br>
                            <ul>
                              <li>In case of discount granted or corporate agreed rate, the discount will be deducted from the last payment.</li>
                              <li>will be charged 80 L.E. The final transcript will be issued by VU</li>
                            </ul>
                            <br><strong>Refund and Non-refund Policy:</strong><br>
                            <ul>
                              <li>Refund is applied 10 days prior to start of the program deducted 15%.  No refund will be applied after this period.</li>
                              <li>If the participant drops the program, she/he is not eligible to refund for the attended courses. Participant will be refunded the unattended courses deducted 15%  </li>
                              <li>Non-refundable fees: General Application Fee, Make-Up Exam and Drop/Add Fee</li>
                              <li>Transcripts requested during the program will be issued by Brilliance Business School</li>
                            </ul>
                            </p>
                            <br><strong>Payment Policy for Corporate Participants </strong><br>
                            <ul>
                              <li>All the points in corporate section are valid for corporate only</li>
                              <li>Participants who are financed by their corporate must issue a Corporate Sponsorship Letter (CSL) on corporate letterhead and signed by the department designated for these issues in the corporate before joining the program.</li>
                              <li>CSL must include the names of participants that the corporate finances, the percentage of corporate financial contribution, the method of payment (cash, cheque or bank transfer), the time of payment settling, process of payment, the person or department in charge to follow up with</li>
                              <li>Corporate is fully responsible for settling the payment as agreed whether to deliver cash or cheque with a representative to the school or through bank transfer, corporate is required to send a scanned copy of the receipt to the Finance department</li>
                              <li>Corporate must sign a copy of this document which indicates that the corporate is fully aware of the ‘Payment Plan’ and ‘Academic Policy and Regulations and enclose it with CSL. </li>
                            </ul>
                            </p></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12">
                  <p> </p>
                </div>
                <div class="col-md-12">
                <p>Upon signing, I hereby affirm my full understanding and complete awareness to the “Academic Policy, Regulations, and Payment Policy” stated here by the School; and I confirm my commitment to it</p>
                  <div class="bd rounded table-responsive">
                    <!--<p class="mg-b-0">Do big things with Med Troops, the responsive bootstrap 4 admin template.</p>-->
                    <table class="table table-bordered" style="padding-bottom: 0; margin-bottom: 0;">
                      <tbody>
                        <tr>
                          <th style="width:200px;">Signature :</th>
                          <th style="width:350px;"> </th>
                          <th style="width:200px;">Date :</th>
                          <th style="width:350px;">{{$now}}</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <p>© Brilliance Business School–Payment Plan and Academic Policies and Regulations</p>
                </div>
              </div>  
            </div>
          </div>
          <div class="row row-sm mg-t-20">
                <div class="col-12" style="text-align: center;">
                <button id="print"  onclick="printDiv('printableArea')" class="btn btn-oblong btn-outline-primary mg-b-10"><i class="fa fa-print"></i> Print</button>
                </div>
              </div>
        </div>
@endsection
@include('admin.pages.print.invoice.scripts')
<?php

namespace App\Helpers;

class Request
{
	/**
     * @param $request
     * @return bool
     */
    public static function isEdit($request)
    {
        return str_contains($request->route()->getName(), 'edit');
    }

    /**
     * @param $request
     * @return bool
     */
    public static function notEdit($request)
    {
        return !str_contains($request->route()->getName(), 'edit');
    }
    /**
     * @param $request
     * @return array
     */
    public static function mergeTransAttrs($request)
    {
		if ($request->input('translatedAttrs'))
        return array_merge($request->all(), $request->input('translatedAttrs'));
	    
		else
		return $request->all();
    }

    /**
     * this will return request validation rules like
     *  'translatedAttrs' => 'required|array',
     * 'translatedAttrs.en.name' => 'required|min:3',
     * @param $attrs
     * @return array
     */
    public static function transRules(array $attrs)
    {
        $rules = [];
        $rules['translatedAttrs'] = 'required|array';
        foreach ($attrs as $attr => $rule) {
            $rules['translatedAttrs.en.' . $attr] = $rule;
            $rules['translatedAttrs.ar.' . $attr] = $rule;
        }
        return $rules;
    }
}
<?php

class Ck_fileController extends AuthorizedController
{

    protected $ck_file;

    public function __construct(Ck_file $ck_file)
    {
      $this->ck_file = $ck_file;
    }

    public function postUpload()
    {
        $input = Input::all();

        $rules = array(
            'upload' => 'image|max:15000|required',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->messages(), 400);
        }
        unset($input['csrf_token']);
        unset($input['CKEditor']);
        unset($input['CKEditorFuncNum']);
        unset($input['langCode']);
        $ck_file = $this->ck_file->create($input);

        $t = "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(1, '/ideabank/public/".$ck_file->upload->url('original')."', '');</script>";
        return $t;
    }
}

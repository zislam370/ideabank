<?php
/**
* Language file for form field validation
*
*/
return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    "accepted"         => "ইনপুট অতিগুরুত্বপূর্ন",
    "active_url"       => "ইনপুট সঠিক ইউআরএল নয়",
    "after"            => "ইনপুট অবশ্যই পরের তারিখ  হবে  :date",
    "alpha"            => "ইনপুট শুধুমাত্র অক্ষর থাকতে পারে",
    "alpha_dash"       => "ইনপুট শুধুমাত্র অক্ষর, সংখ্যা, এবং ড্যাশ থাকতে পারে",
    "alpha_num"        => "ইনপুট শুধুমাত্র অক্ষর এবং সংখ্যার থাকতে পারে",
    "before"           => "ইনপুট অবশ্যই পূর্বের তারিখ  হবে :date",
    "between"          => array(
        "numeric" => "ইনপুট অবশ্যই :min - :max এর মধে হবে",
        "file"    => "ইনপুট অবশ্যই :min - :max কিলোবাইট মধে হবে",
        "string"  => "ইনপুট অবশ্যই :min - :max অক্ষরের মধে হবে",
    ),
    "confirmed"        => "ইনপুট নিশ্চিতকরণ মেলে না",
    "date"             => "ইনপুট  সঠিক তারিখ নয় ",
    "date_format"      => "ইনপুট পদ্ধতির সাথে মিলছে না :format",
    "different"        => "ইনপুট এবং :other অবশ্যই আলাদা হবে",
    "digits"           => "ইনপুট অবশ্যই :digits সংখ্যা",
    "digits_between"   => "ইনপুট অবশ্যই :min এবং :max সংখ্যার মধে হবে",
    "email"            => "আপনার দেওয়া ইমেল অ্যাড্রেসটি সঠিক নয়",
    "exists"           => "নির্বাচিত ইনপুট সঠিক নয়",
    "image"            => "ইনপুট অবশ্যই একটি ছবি হতে হবে",
    "in"               => "নির্বাচিত ইনপুট সঠিক নয়",
    "integer"          => "ইনপুট অবশ্যই পূর্ণসংখ্যা হতে হবে",
    "ip"               => "ইনপুট অবশ্যই একটি সঠিক আইপি অ্যাড্রেস হবে",
    "max"              => array(
        "numeric" => "ইনপুট সর্বোচ্চ :max",
        "file"    => "ইনপুট সর্বোচ্চ :max কিলোবাইট হবে",
        "string"  => "ইনপুট সর্বোচ্চ :max  অক্ষরের হবে",
    ),
    "mimes"            => "ইনপুট অবশই ফাইলের ধরণ হবে: :values",
    "min"              => array(
        "numeric" => "ইনপুট কমপক্ষে :min.",
        "file"    => "ইনপুট কমপক্ষে :min কিলোবাইট হবে",
        "string"  => "ইনপুট কমপক্ষে :min অক্ষরের হবে.",
    ),
    "not_in"           => "নির্বাচিত ইনপুট সঠিক নয়",
    "numeric"          => "ইনপুট একটি নম্বর হতে হবে. ",
    "regex"            => "ইনপুট পদ্ধতি সঠিক নয়",
    "required"         => "আবশ্যকীয়",
    "required_if"      => "ইনপুট ক্ষেত্রটি প্রয়োজন যখন :other  :value",
    "required_with"    => "ইনপুট ক্ষেত্রটি প্রয়োজন যখন :values থাকবে",
    "required_without" => "ইনপুট ক্ষেত্রটি প্রয়োজন যখন :values না থাকবে",
    "same"             => "পাসওয়ার্ড এবং পুনঃ পাসওয়ার্ড একই হইতে হবে",
    "size"             => array(
        "numeric" => "ইনপুট অবশ্যই :size সংখ্যার হবে",
        "file"    => "ইনপুট অবশ্যই :size কিলোবাইট হবে",
        "string"  => "ইনপুট অবশ্যই :size অক্ষরের হবে",
    ),
    "unique"           => "ইনপুট ইতিমধ্যে গ্রহণ করা হয়েছে",
    "url"              => "সঠিক ইউআরএল (url) নয় ",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(),

    "captcha" => 'টাইপকৃত শব্দটি সঠিক নয়',
    "mobile"  => 'আপনার প্রাদানকৃত মোবাইল নাম্বারটি সঠিক নয়',




);

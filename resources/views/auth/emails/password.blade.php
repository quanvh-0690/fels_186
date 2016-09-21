{{ trans('auth.link_reset_password') }} <a href="{{ $link = action('Auth\PasswordController@showResetForm', $token) . '?email=' . urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

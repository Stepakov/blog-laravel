Please, verify your email.

{{ route( 'verification.verify', [
     'id' => $user->getKey(),
     'hash' => sha1($user->getEmailForVerification())
] ) }}

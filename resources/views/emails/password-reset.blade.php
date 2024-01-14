<!-- resources/views/emails/password-reset.blade.php -->

<p>You have requested to reset your password. Click the link below to reset your password:</p>

<a href="{{ route('password.reset.form', $token) }}">Alterar Senha</a>

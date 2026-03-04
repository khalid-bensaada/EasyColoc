<!DOCTYPE html>
<html>

<head>
    <title>Invitation</title>
</head>

<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <h1>Hello!</h1>
    <p>You have been invited to join the colocation: <strong>{{ $colocation->name }}</strong>.</p>

    <p>Use the following token to join us:</p>
    <div
        style="background: #f3f3f3; padding: 10px; border: 1px dashed #ccc; display: inline-block; font-size: 1.2em; font-weight: bold;">
        {{ $token }}
    </div>

    <p>Or simply click the button below to join directly:</p>

    <div style="margin: 20px 0;">
        <a href="{{ route('member.colocations.userDash', ['token' => $token]) }}" style="background-color: #4CAF50; 
                  color: white; 
                  padding: 14px 25px; 
                  text-align: center; 
                  text-decoration: none; 
                  display: inline-block; 
                  border-radius: 5px; 
                  font-weight: bold;">
            Join the Colocation
        </a>
    </div>

    <p>If you aren't logged in, you will be prompted to do so first.</p>
    <p>Thank you!</p>
</body>

</html>
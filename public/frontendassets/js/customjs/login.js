

function handleCredentialResponse(response) {
    console.log("Encoded JWT ID token: " + response.credential);
  }
  window.onload = function () {
    google.accounts.id.initialize({
      client_id: "523174149326-vdd9cl1gkavbcqpo6peaavh4ckqpl60e.apps.googleusercontent.com",
      callback: handleCredentialResponse
    });
    google.accounts.id.renderButton(
      document.getElementById("login_by_gmail"),
      { theme: "outline", size: "large" }  // customization attributes
    );
    google.accounts.id.prompt(); // also display the One Tap dialog
  }
            
//523174149326-vdd9cl1gkavbcqpo6peaavh4ckqpl60e.apps.googleusercontent.com
//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

/*
{"installed":
    {
        "client_id":"523174149326-vdd9cl1gkavbcqpo6peaavh4ckqpl60e.apps.googleusercontent.com",
        "project_id":"glasprofi-demo",
        "auth_uri":"https://accounts.google.com/o/oauth2/auth",
        "token_uri":"https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs",
        "client_secret":"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",
        "redirect_uris":["http://localhost"]
    }
}
*/
function checkPass()
    {
        var MDP = document.getElementById("mdp").value;
        var confMDP = document.getElementById("Confmdp").value;
        var div_comp = document.getElementById("divcomp");
        var MDP_isOK = false;
        
        if(MDP != confMDP)
        {
            divcomp.innerHTML = "Mot de passe différent";
            MDP_isOK = false;
        }
        else
        {
            divcomp.innerHTML = "";
            MDP_isOK = true;
        }
        checkInfos()
    }

function checkMail()
    {
        var Mail = document.getElementById("mail").value;
        var confMail = document.getElementById("ConfMail").value;
        var div_comp_mail = document.getElementById("divcompmail");
        var Mail_isOK = false;
        
        if(Mail != confMail)
        {
            divcompmail.innerHTML = "Le mail doit être le même";
            Mail_isOK = false;
        }
        else
        {
            divcompmail.innerHTML = "";
            Mail_isOK = true;
        }
        checkInfos()
    }

function checkInfos()
    {
        if (Mail_isOK == true && MDP_isOK == true)
        {
            element.setAttribute("disabled", "disabled");
        }
        else
        {
            element.removeAttribute("disabled");
        }
    }

function test()
{
    console.log("test");
    Console.log("test");
}
    
function Enregistrement() 
    {
        'use strict';
        var snackbarContainer = document.querySelector('#send');
        var showToastButton = document.querySelector('#envoyer');
        showToastButton.addEventListener('click', function() {
            'use strict';
            var data = {message: 'Inscription en cours... '};
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
            setTimeOut(fonctionAExecuter, 3000)
        });
    };

function montreSelecteurType()
{ 
    document.getElementById('newType').style.display = "none"
    document.getElementById('SelecteurType').style.display = "block";
}

function cacheSelecteurType()
{
    document.getElementById('newType').style.display = "block"
    document.getElementById('SelecteurType').style.display = "none";
}
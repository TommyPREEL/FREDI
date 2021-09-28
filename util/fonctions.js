function checkChamps()
{
	var mememdp = false;
	var mdp = document.getElementById("mdp").value;
	var confirmmdp = document.getElementById("confirmmdp").value;
	if (mdp != confirmmdp)
		alert("Les mots de passe ne correspondent pas.");
	else
		//mememdp = true;
	document.formInscription.submit();
	//return mememdp;
}
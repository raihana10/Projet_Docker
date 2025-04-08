<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>salam l3alam</title>
</head>
<fieldset>
    <legend> Informations identitaires </legend>
      <label for=”nom”> Nom : </label>
        <input id=”nom” type=”text” name=”nom” >
         <br > <br >
      <label for=”prenom”> Prenom : </label>
       <input id=”prenom” type=”text” name=”prenom” >
         <br > <br >
      <label for=”cne”> Code National Etudiant : </label>
        <input id=”cne” type=”text” name=”cne” >
      <br> <br>
      <label for="Sexe"> Sexe</label>
        <select name="Genre" id="Sexe">
            <option value="Femme"> F</option>
            <option value="Homme"> M</option>
        </select>
    </fieldset>
    <br> <br> 
        <fieldset>
            <legend>Competences</legend>
            <label for="diplome"> Diplome :</label>
        <select name="diplome" id="diplome">
            <option value="licence">Licence</option>
            <option value="master">Master</option>
            <option value="doctorat">Doctorat</option>
        </select>
        <br> <br>
        <label for=”ecole”> Ecole : </label>
        <input id=”ecole” type=”text” name=”ecole” >
         <br > <br >
         <label for=”experience”> Experience : </label>
         <input id=”experience” type=”text” name=”experience”>

        </fieldset>
</html>
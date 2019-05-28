<?php require 'Header.php';?>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <h3>Calculez les calories dépensées ainsi que vos points de bonheur accumulés</h3>
    <form action="CalculCalories.php" method="POST">
        <table>    
            <tr>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" value="2019-05-22"
                        name="dtDeb" id="dtDeb">
                        <label class="mdl-textfield__label" for="dtDeb"> Date de debut :</label>
                    </div>
                </td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="date" value="2019-07-22"
                        name="dtFin" id="dtFin">
                        <label class="mdl-textfield__label" for="dtFin"> Date de fin :</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    <button style="float: right;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored decale" 
                    id="Creer" type="submit">Calculer</button>
                </td>
            </tr>
        </table> 
    </form>
</div>

<?php
    if(!empty($_POST['dtDeb']) && !empty($_POST['dtFin']))
    {
        $req = $bdd->prepare('SELECT sum(depCalories) as totalcal,(SELECT sum(ptsBonheur) 
                                                                    FROM Inscription I, Animation AN
                                                                    WHERE I.CODEANIM = AN.CODEANIM
                                                                    AND I.USER = "'.$_SESSION['ID'].'") as totalBon
        FROM Inscription I, Animation AN
        WHERE I.CODEANIM = AN.CODEANIM
        AND I.USER = "'.$_SESSION['ID'].'"');
        $req->execute();
        $resultat = $req->fetchAll();

        var_dump($resultat);
    }
?>
<?php require 'Footer.php'; ?>
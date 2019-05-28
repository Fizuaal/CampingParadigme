<?php require 'Header.php';?>

<div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <h3>Calculez les calories dépensées ainsi que vos points de bonheur accumulés</h3>
    <form action="F_CalculCal.php">
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
        </table> 
    </form>
</div>

<?php
    if(!empty($_POST['dtDeb']) && !empty($_POST['dtFin']))
    {
        
    }
?>
<?php require 'Footer.php'; ?>
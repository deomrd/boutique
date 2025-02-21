<div class="col-lg-3 col-md-3">

    <div class="col-lg-12 col-md-12">
      <label for="produit">Nom de la mousse </label> <br>
      <select class="form-control" name="mousse">
        <option value="">Choix de la mousse</option>
        <?php
        $req=$bdd->query("SELECT * FROM produits WHERE categorie='mousse' && statut=1 && quantite>0 ORDER BY nomProd ASC");
        foreach ($req as $r) {
        ?>
        <option value="<?= $r['idProd']; ?>"><?= $r['nomProd']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="col-lg-12 col-md-12">
      <label for="quant">Nombre des bouteilles </label> <br>
      <input type="number" name="quantitemousse" id="quant" placeholder="Nombre des bouteilles" class="form-control">
    </div>                    

    <div class="col-lg-12 col-md-12" style="margin-top: 10px;">
      <div style="float: left;"><input type="submit" name="addmousse" value="Ajouter" class="btn btn-primary"></div>
    </div>
    <br>
    <div style="text-align: center; font-weight: bold;">
      <?php if (isset($erreurmousse)) { echo $erreurmousse; } ?>
    </div>
</div>
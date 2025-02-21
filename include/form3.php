<div class="col-lg-3 col-md-3">

    <div class="col-lg-12 col-md-12">
      <label for="produit">Nom du liqueur </label> <br>
      <select class="form-control" name="liqueur">
        <option value="">Choix du liqueur</option>
        <?php
        $req=$bdd->query("SELECT * FROM produits WHERE categorie='liqueur' && statut=1 && quantite>0 ORDER BY nomProd ASC");
        foreach ($req as $r) {
        ?>
        <option value="<?= $r['idProd']; ?>"><?= $r['nomProd']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>

    <div class="col-lg-12 col-md-12" hidden="">
      <label for="quant">Devise </label> <br>
      <input type="number" name="devise" id="quant" placeholder="Nombre des bouteilles" class="form-control">
    </div> 

    <div class="col-lg-12 col-md-12">
      <label for="quant">Nombre des bouteilles </label> <br>
      <input type="number" name="quantiteliqueur" id="quant" placeholder="Nombre des bouteilles" class="form-control">
    </div>                    

    <div class="col-lg-12 col-md-12" style="margin-top: 10px;">
      <div style="float: left;"><input type="submit" name="addliqueur" value="Ajouter" class="btn btn-primary"></div>
    </div> 

    <br>
    <div style="text-align: center; font-weight: bold;">
      <?php if (isset($erreurliqueur)) { echo $erreurliqueur; } ?>
    </div>

</div>
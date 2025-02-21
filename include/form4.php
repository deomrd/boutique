<div class="col-lg-3 col-md-3">

    <div class="col-lg-12 col-md-12">
      <label for="produit">Nom de la recette </label> <br>
      <select class="form-control" name="recette">
        <option value="">Choix de la recette</option>
        <?php
        $req=$bdd->query("SELECT * FROM produits WHERE categorie='Recette' && statut=1 ORDER BY nomProd ASC");
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
      <label for="quant">Nombre des plats </label> <br>
      <input type="number" name="quantiterecette" id="quant" placeholder="Nombre des plats" class="form-control">
    </div>                    

    <div class="col-lg-12 col-md-12" style="margin-top: 10px;">
      <div style="float: left;"><input type="submit" name="addrecette" value="Ajouter" class="btn btn-primary"></div>
    </div> 
    <br>
    <div style="text-align: center; font-weight: bold;">
      <?php if (isset($erreurrecette)) { echo $erreurrecette; } ?>
    </div>
</div>
<div class="col-lg-12 col-md-12">
                 
  <div class="col-lg-12 col-md-12">
    <label for="nom">Nom du bénéficiaire (*) </label> <br>
    <input type="text" name="nom" id="nom" placeholder="Nom du bénéficiaire" class="form-control">
  </div>  

   <div class="col-lg-12 col-md-12">
    <label for="server">Nom du serveur </label> <br>
    <select class="form-control" name="serveur">
      <option></option>
      <?php
        $serv=getBy1ord($bdd, 'serveurs', 'statut', 1, 'nomServ', 'ASC');
        foreach ($serv as $s) {
        ?>
        <option value="<?= $s['nomServ'] ?>"><?= $s['nomServ'] ?></option>
        <?php
        }
      ?>
    </select>
  </div>  

</div>

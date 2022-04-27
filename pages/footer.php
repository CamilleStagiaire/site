<footer class="text-center sticky-bottom mt-5">

  <div class="card text-center">
    <div class="card-header">
      Footer
    </div>

    <div class="row mt-2 me-2">
      <div class="col-md-3 text-start lh-1 fs-6">
        <h4 class="ms-3">Horaires</h4>
        <?= afficherHoraire() ?>
      </div>

      <div class="col-md-6">
        <h4 class="card-title mb-3">newsletter</h4>
        <form action="newsletter.php" method="POST" class="row d-flex justify-content-center">
        <div class="col-auto ">
            <input class="form-control" type="email" name="email" placeholder="Entrez votre email" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>
    </form>
      </div>

      <div class="col-md-3">
        <ul class="list-group text-center">
          <?= navMenu('list-group-item') ?>
        </ul>
        <?php if (!empty($_SESSION['username'])) : ?>
        <ul class="list-group text-center">
          <li ><a class="nav-link active" href="profil.php">Profil</a></li>
        </ul>
        <?php endif ?>
      </div>
    </div>
    <div class="card-footer text-muted"></div>

</footer>

</body>

</html>
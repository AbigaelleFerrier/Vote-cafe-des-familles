<!doctype html>
<?php
function p(...$var) {
    echo '<pre>';
    foreach($var as $v) {
        var_dump($v);
    }
    echo '</pre>';
}

$propals = json_decode(file_get_contents('proposition.json'));

// p($propals);

?>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Je vote pour le futur nom de ce lieu</title>

    <style>
        body {
            background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
        }

        .w-33 {
            width: 32%;
        }
    </style>

  </head>
  <body class="vh-100">
    <main class="d-flex flex-column p-5 w-auto">
        <div class="p-3 text-center card mt-3">
            <h1>Je Vote</h1>
            <h2>Pour le futur nom de ce lieu</h2>
        </div>

        <div class="d-flex flex-wrap justify-content-between">
            <?php foreach($propals as $propal) : ?>
                <div class="w-33 p-3 mt-3 card">
                    <h2 class="text-center">
                        <?php echo $propal->nom; ?>
                    </h2>
                    <button
                        type="button"
                        class="btn btn-outline-success"
                        data-bs-toggle="modal"
                        data-bs-target="#Modal-<?php echo $propal->ID; ?>"
                    >
                        Je vote pour !
                    </button>

                    <div id="Modal-<?php echo $propal->ID; ?>" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5
                                        class="modal-title"
                                    >
                                        Je vote pour :
                                        <strong><?php echo $propal->nom; ?></strong>
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/add-vote.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $propal->ID; ?>">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email<span style="color:red">*</span></label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="email"
                                                name="email"
                                                required
                                            >
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="rgpd" name="rgpd" required>
                                            <label
                                                class="form-check-label"
                                                for="rgpd"
                                            >
                                                Je consens à ce que mes données soit utilisé dans le cadre de ce vote uniquement<span style="color:red">*</span>
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Je vote</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        J'ai changer d'avis
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <div class="d-flex text-align justify-content-center mb-5">
        <a class="mx-2" style="color:white;" target="_blank" href="https://github.com/AbigaelleFerrier/Vote-cafe-des-familles">Code source</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>

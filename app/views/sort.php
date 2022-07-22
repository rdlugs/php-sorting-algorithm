<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorting Algorithm</title>

    <link rel="stylesheet" href="/public/css/app.css">
</head>

<body>

    <div class="container">
        <div class="card">
            <h1>Sorting Algorithm</h1>
            <hr class="hr" />
            <form action="./sort" method="POST">
                <div class="form-container">
                    <div class="input-group" required>
                        <select name="sort_strategy" id="" class="input">
                            <option value="quick_sort">Quick Sort</option>
                            <option value="merge_sort">Merge Sort</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <input type="text" name="sort_input" placeholder="Enter String to Sort" required />
                    </div>

                    <div class="input-group">
                        <button type="submit">Sort</button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($sorted_string)) {
            ?>

                <hr class="hr" />
                <h3>Results: </h3>
                <p><b>Original String:</b> <?= $original_string ?></p>
                <p><b>Sorted String:</b> <?= $sorted_string ?></p>
                <p><b>Sorting Strategy:</b> <?= $sorting_strategy ?></p>
            <?php
            }
            ?>
        </div>
    </div>

</body>

</html>
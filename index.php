<?php  
include "inc/quiz.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div id="quiz-box">
            <?php if ($show_score == false):?>
            <?php if (!empty($toast)) { echo $toast; } ?>
            <p class="breadcrumbs">Question <?php echo count($_SESSION['used_indexs']); ?> of <?php echo $totalQuestions; ?> </p>
            <p class="quiz">What is <?php echo $question["leftAdder"]; ?> + <?php echo $question["rightAdder"]; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $index; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[0]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[1]; ?>" />
                <input type="submit" class="btn" name="answer" value="<?php echo $answers[2]; ?>" />
            </form>
        <?php endif; ?>
        <?php if ($show_score == true):?>
        <?php  echo "<h1>You got " . $_SESSION['totalCorrect'] . " correct out of " . $totalQuestions . "</h1><br>";
               echo '<form action="index.php" method="post"> 
                        <input type="submit" class="btn" name="re_quiz" value="Take Quiz Again" />
                     </form>'; 
             endif; 
        ?>    
        </div>
    </div>
</body>
</html>
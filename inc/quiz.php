<?php
// Start the session
session_start();
// Include questions from the questions.php file
include "questions.php";
// SET THE "$show_score" TO FALSE TO SHOW THE QUESTIONS AND CHOICES 
$show_score = false;

/*--------------------------------------------------------------------------------------------------------------------------------*/
// USE THE GLOBAL VARIABLE $_SERVER TO CHECK IF THE REQUEST METHOD IS EITHER 'POST' OR 'GET' 
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    // TEST THE SUBMITED ANSWER FROM THE FORMS INPUT ATTRIBUTE 'name ="answer"' USING $_POST['answer']
    // WITH THE CORRECT ANSWER FROM THE "questions " MULTIDEMENSIONAL ARRAY 
    // USING THE RANDOM NUMBER GENERATED VARIABBLE "$index" FROM THE SAME FORMS HIDDEN INPUT FIELDS ATTRIBUTE 'value="$index"
    // USING THE FORMS INPUT ATTRIBUTE 'name ="id"' AND PASSING THE VALUE AS THE ROW IN THE $questions[""][""] USING $_POST['id'] 
    // AND THEN USING "correctAnswer" COLUMN AS THE VALUE ---> $questions[$_POST['id']["correctAnswer"]
    if ($_POST['answer'] == $questions[$_POST['id']]["correctAnswer"]) 
    {
        // INCREASE THE "$_SESSION['totalCorrect'] SESSION BY ONE IF THE "$_POST['answer']" IS EQUAL TO "$questions[$_POST['id']]["correctAnswer"]" 
        $_SESSION['totalCorrect']++;
        // CHANGE THE "$toast" VARIABLE TO REEFLECT THAT THE CORRECT ANSWER WAS CHOOSEN
        $toast = "<p style='color:gold;'>Well done, you're correct!</p>";

    }else
    {
        // ELSE CHANGE THE "$toast" VARIABLE TO REEFLECT THAT THE WRONG ANSWER WAS CHOOSEN
        $toast = "<p style='color:red;'>Bummer, you are incorrect</p>";
    }
}
/*--------------------------------------------------------------------------------------------------------------------------------*/
// CHECK TO SEE IF THE SESSION "$_SESSION['used_indexs']" IS NOT SET
if (!isset($_SESSION['used_indexs'])) 
{
    // CREATE A SESSION VARIABLE TO HOLD THE ARRAY OF INDEXS FROM THE "quesions" MULTIDEMESIONAL ARRAY  
    $_SESSION['used_indexs']  = array();
 // CREATE A SESSION VARIABLE TO HOLD THE NUMBER OF CORRECT ANSWERS   
    $_SESSION['totalCorrect'] = 0;
}
// USE THE VARIABLE "$totalQuestions" TO STORE THE TOTAL COUNT OF QUESTION FROM THE "questions" MULTIDEMESSIONAL ARRAY
$totalQuestions = count($questions);

/*----------------------------------------------------------------------------------------------------------------------------------*/

// IF STATEMENT TEST IF "$_SESSION['used_indexs']" COUNT IS EQUAL TO THE "$_SESSION['totalCorrect']" COUNT TO END TEST
if (count($_SESSION['used_indexs']) == $totalQuestions) 
{
    // WHEN THE TEST ENDS THE "$_SESSION['used_indexs']" IS RESET WITH NO VALUES
    $_SESSION['used_indexs']  = array();
    // WHEN THE TEST ENDS THE "$show_score" VARIABLE IS SET TO "true" SHOWING THE TOTAL CORRECT ANSWERS AND TOTAL QUESTION COUNT
    $show_score = true;
 }else
{  // ELSE SET THE VARIABLE "$showscore" TO FALSE SHWOING THE QUESTIONS AND CHOICES
   $show_score = false;
   // THE IF STATEMENT TEST IF "$_SESSION['used_indexs']" IS EQUAL TO 0 THE START OF THE TEST
   if (count($_SESSION['used_indexs']) == 0) 
   {   // IF "$_SESSION['used_indexs']" IS EQUAL TO 0 SET THE "$_SESSION['totalCorrect']" TO 0
       $_SESSION['totalCorrect'] = 0;
       // IF "$_SESSION['used_indexs']" IS EQUAL TO 0 SET THE "$toast" VARIABLE TO A EMPTY STRING
       $toast                    = " ";
   }
   // THE "do{}while()" LOOP LOOPS THROUGH THE VARIABLE "$index" HOLDING THE RANDOM FUNCTION CONTAINING THE RANGE "0-9"
   // TESTING THE "in_array()" FUNCTION TO SEE IF THE VARIABLE "$index" WITH THE VALUE OF A RANDOM NUMBER 0-9 
   // IS IN THE "$_SESSION['used_indexs']" ARRAY    
   do 
   {
      $index = rand(0, 9);
   } while (in_array($index, $_SESSION['used_indexs']));

   // THE "$question" VARIABLE HAS THE VALUE OF THE "questions[$index]" MULTIDEMESIONAL ARRAY WITH A RANDOM INDEX IN THE ROW COLUMN 
   $question = $questions[$index];
   // THE "array_push" FUNCTION CREATES A NEW INDEX WITH THE WITH THE RANDOM NUMBER STORED IN THE "$index" VARIABLE
   array_push($_SESSION['used_indexs'], $index);
   // THE "$answers" VARIABLE IS A MULTIDEMESIONAL ARRAY THAT HAS THE LAST THREE ANWSER VALUES OF THE "$questions[][]" MULTIDEMESIONAL ARRAY  
   $answers  = array($question["correctAnswer"], $question["firstIncorrectAnswer"], $question["secondIncorrectAnswer"]);
   // THE "shuffle()" FUNCTION WILL SHUFFLE THE INDEX OF THE "$answers" ARRAY CHANGING THE POSTION OF THE 3 CHOICES
   shuffle($answers);
}
/*----------------------------------------------------------------------------------------------------------------------------------*/
// WHEN THE TEST HAS ENDED THIS IF STATEMENT WILL TEST IF THE INOUT WITH THE NAME "re-quiz" HAS BEEN SET
if (isset($_POST['re_quiz'])) 
{   // IF "re-quiz" HAS BEEN SET
    // SET THE "$show_score" VARIABLE TO FALSE SHWOING THE QUESTIONS AND CHOICES
    $show_score = false;
    // SET THE "$_SESSION['used_indexs']" WITH NO VALUES
    $_SESSION['used_indexs']  = array();
    // SET THE "$_SESSION['totalCorrect']" TO 0
    $_SESSION['totalCorrect'] = 0;
    // SET THE "$toast" VARIABLE TO A EMPTY STRING
    $toast = " ";
    // SEND THE TEST TAKER TO THE INDEX PAGE TO START THE TEST
    header("location:index.php");
}
/*----------------------------------------------------------------------------------------------------------------------------------*/
<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Budget
{

    /**
     * @var object The database connection
     */
    private $db_connection = null;

    /**
     * @var array Collection of error messages
     */
    public $errors = array();

    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    public function __construct()
    {
        
    }

    public function createNewBudget($budgetName,$budgetIdToDuplicate)
    {
        // create a database connection, using the constants from config/db.php (which we loaded in index.php)
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8"))
        {
            $this->errors[] = $this->db_connection->error;
        }

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno)
        {
            $sql = "SELECT budgetId FROM budget WHERE userId = '" . $_SESSION['user_id'] . "';";
            $query_check_user_budget = $this->db_connection->query($sql);

            $_SESSION['user_number_of_budgets'] = $query_check_user_budget->num_rows;

            if ($query_check_user_budget->num_rows >= MAX_BUDGETS)
            {
                $this->errors[] = "Sorry, you can't create more than " . MAX_BUDGETS . " budgets. Please delete one and try again.";
            }
            else //less than MAX_BUDGETS so create or duplicate one
            {
                $sql = "INSERT INTO budget (userId, budgetName, dateCreated) VALUES ('" . $_SESSION['user_id'] . "','" . $budgetName . "', NOW());";
                $query_new_user_budget = $this->db_connection->query($sql);

                if ($query_new_user_budget)
                {
                    $_SESSION['user_budgetid'] = $this->db_connection->insert_id;
                    
                    if ($budgetIdToDuplicate == "new") //create new budget
                    {
                        $this->buildFirstTimeBudgetDetails($_SESSION['user_budgetid']);
                    }
                    
                    if (!empty($budgetIdToDuplicate)) //duplicate the passed in budgetId
                    {
                        $this->duplicateBudgetDetails($_SESSION['user_budgetid'], $budgetIdToDuplicate);
                    }
                    else // no id to duplicate, make a new one
                    {
                        $this->buildFirstTimeBudgetDetails($_SESSION['user_budgetid']);
                    }

                    $_SESSION['user_has_budget'] = 1;
                }
                else
                {
                    $this->errors[] = "Sorry, your budget creation failed. Please go back and try again.";
                }
            }
        }
        else
        {
            $this->errors[] = "Database connection problem.";
        }
    }

    private function buildFirstTimeBudgetDetails($budgetId)
    {
        $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $sql = $db_connection->prepare("SELECT categoryId FROM category");

        if ($sql->execute())
        {
            $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);

            $sql = $db_connection->prepare("INSERT INTO budgetDetail (budgetId, categoryId) VALUES (:budgetId, :categoryId)");

            foreach ($ResultsToReturn as $row)
            {
                $sql->bindParam(':budgetId', $budgetId);
                $sql->bindParam(':categoryId', $row["categoryId"]);
                $sql->execute();
            }
        }
        else
        {
            $this->errors[] = "Database connection problem.";
        }
    }

    private function duplicateBudgetDetails($newBudgetId, $oldBudgetId)
    {
        $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        
        $sql = $db_connection->prepare("INSERT INTO budgetDetail (budgetId, categoryId, budgetSelfAmount, budgetSpouseAmount) SELECT :newBudgetId, categoryId, budgetSelfAmount, budgetSpouseAmount FROM budgetDetail WHERE budgetId = :oldBudgetId");

        $sql->bindParam(':newBudgetId', $newBudgetId);
        $sql->bindParam(':oldBudgetId', $oldBudgetId);

        $sql->execute();
    }

    public function getNumberOfUserBudgets()
    {
        return $_SESSION['user_number_of_budgets'];
    }

}

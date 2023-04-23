<div class="searchbar container">
    <form action="search.php" method="POST" class="form">
        <div class="form_block">
            <label class="form_label" for="query_label">Search </label>
            <div class='bar'><input type="text" id="query_label" name="search_str" />
                <input type="submit" value="Search" />
            </div>
        </div>
    </form>
</div>


<style>
    .form_label {
        font-size: 2rem;
        font-weight: 700;
        padding: 0px;
    }

    .form_block {
        padding: 0px;
        margin: 0px;
        width: 100%;
    }

    input {
        padding: 1rem;
    }
    .bar{
        display: flex;
        flex-direction: row;
    }
    input[type="text"] {
        width: 90%;
    }

    input[type="submit"] {
        width: 10%;
    }
</style>
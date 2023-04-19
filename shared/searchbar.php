<div class="searchbar container">
    <form action="search.php" method="POST" class="form">
        <div class="form_block">
            <label class="form_label" for="query_label">Search </label>
            <input type="text" id="query_label" name="search_str" />
        </div>
        <input type="submit" value="submit" />
    </form>
</div>


<style>
    .form_label {
        font-size: 2rem;
        font-weight: 700;
    }

    .form_block {
        width: 100%;
    }

    input {
        padding: 1rem;
    }

    input[type="submit"] {
        width: 10%;
    }
</style>
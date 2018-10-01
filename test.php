<style>
    .radios input{
        
    }
</style>

<?php
    $url = '/vprasanja-odgovori/test.php';
    $izbira = '?izbira=0';
    if(isset($_GET['sortBy'])){
        $sort = '&sortBy='.$_GET['sortBy'];
        header("Location: ".$url.$izbira.$sort);
        
    }
    
    echo '<span id="sort-by">
        <p>Razvrsti po:
        <a href="'.$url.'?sortBy=time'.'"> čas </a>
        <a href="'.$url.'?sortBy=rating'.'"> rating </a>
        </p>
    </span>';
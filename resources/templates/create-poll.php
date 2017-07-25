<?php
    // load up your config file
    require_once("../config.php");
	require_once(LIBRARY_PATH . "/Poll.php");
	
	$poll = new Poll('California vibes', '10 hours', 'All Cali and beyond.');
?>

<main class="page">
    <div class="polls">
        <div class="polls__item">
            <h3 class="item__title">Create new poll</h3>
            <div class="item__icon__wrapper">
                <a class="item__link" href="#poll-form" rel="modal:open">
                    <img src="assets/plus.svg" class="item__icon pulse" alt="Plus sign icon">
                </a>
            </div>
        </div>
    </div>
</main>


<form action="observe.php" method="post">
    <input id="gotoToday" type="submit" name="gotoToday" class="none" value=1>
    <label id="gotoTodayLabel" for="gotoToday" class="border canPush">当日</label>
</form>

<div id=prevNext>
    <form action="observe.php" method="post" id=prevForm >
        <input type="hidden" name="prevForm" value=1>
        <input id="prev" type="button" name="prev" value=1 onClick="submitClick(this);">
        <label id="prevLabel" for="prev"><img id="prevImage" src="image/prev.png" alt="前へ" ></label>
    </form>

        <h3 id=space>  </h3>
    <form action="observe.php" method="post" id=nextForm>
        <input type="hidden" name="nextForm" value=1>
        <input id="next" type="button" name="next" value=1 onClick="submitClick(this);">
        <label id="nextLabel" for="next" ><img id="nextImage" src="image/next.png" alt="次へ" ></label>
    </form>
</div>

<h3 id="today"><?php echo htmlspecialchars($now_dateJP).htmlspecialchars('(').htmlspecialchars($week[$now_week]).htmlspecialchars(')'); ?></h3>
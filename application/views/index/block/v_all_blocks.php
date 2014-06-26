<div id="calculation">
    <div id="calculation_line"></div>
</div>

<div id="top_right_stiker_rooms">
    <div id="top_right_stiker_one_room" data-id="1"></div>
    <div id="top_right_stiker_two_room" data-id="2"></div>
    <div id="top_right_stiker_three_room"  data-id="3"></div>
    <div id="top_right_stiker_four_room"  data-id="4"></div>
    <div id="top_right_stiker_five_room" data-id="5"></div>
</div>
<?php if (Request::initial()->controller() == 'Main'):?>
<div id="top_right_stiker">
    <p>Сколько комнат в вашей квартире?</p>
    <a href="#"  class="send_form">Ваша смета</a>
</div>

<div id="instruments_top_left"></div>
<div id="instruments_top_right_1"></div>
<div id="instruments_top_right_2"></div>
<div id="instruments_bottom_left"></div>
<div id="instruments_bottom_right"></div>
<?php endif;?>

<div id="page_up"></div>
 <div id="header">
            <div id="header_left">
                <ul class="navigation">
                    <li><a href="/"><?php if(Request::initial()->controller() == 'Main'):?><span><?php endif;?>услуги<?php if(Request::initial()->controller() == 'Main'):?></span><?php endif;?></a></li>
                    <li><a href="/repair"><?php if(Request::initial()->controller() == 'Repair'):?><span><?php endif;?>о ремонте<?php if(Request::initial()->controller() == 'Repair'):?></span><?php endif;?></a></li>
                    <li><a href="/project"><?php if(Request::initial()->controller() == 'Project'):?><span><?php endif;?>о проекте<?php if(Request::initial()->controller() == 'Project'):?></span><?php endif;?></a></li>
                    <li><a href="/contacts"><?php if(Request::initial()->controller() == 'Contacts'):?><span><?php endif;?>контакты<?php if(Request::initial()->controller() == 'Contacts'):?></span><?php endif;?></a></li>
                </ul>
                <div id="logo"></div>
            </div>
            <div id="header_right">
                <div id="privat">
                    <p>личный кабинет</p>
                </div>
                <div id="sticker"></div>
                <p id="cel">+7 (499) 162-83-96</p>
                <div id="call"></div>
                <h1>Круглосуточно, без выходных</h1>
                <h2>Позвоните и узнайте о действующих акциях</h2>
            </div>
        </div>
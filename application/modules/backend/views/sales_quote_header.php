<div style="margin-bottom: -26rem;">
    <div class="row align-items-center" style="font-size: 10px;">
        <div class="col-xs-3">
            <img src="<?= base_url("assets/backend/images/sq_logo.png") ?>" style="margin-right: 15px; margin-top: 8px;">
        </div>
        <div class="col-xs-6" style="font-size: 11px;">
            <p>JL.Kolonel Sugiono No.78.Banjarmasin
                <br>Indonesia 14462
                <br>www.globalintertech.co.id
                <br>Email glosindotech@gmail.com
                <br>Office 0511 3272707 / +62 821 530 50 685
            </p>
        </div>
        <div class="col-xs-3">
            <h3 class="text-right" style="margin-bottom: 2px;">Sales Quote</h3>
            <div style="border: 1px solid black; padding: 5px; font-size: 12px">
                <div class="col-xs-6 text-left">Quote # </div>
                <div class="col-xs-6 text-right">SQ-<?= date("m", strtotime($sales_quote->created_at)) . date("y", strtotime($sales_quote->created_at)) . sprintf('%03d', $counter) ?></div>
                <div class="col-xs-6 text-left">Date </div>
                <div class="col-xs-6 text-right"><?= date("d/m/Y", strtotime($sales_quote->created_at)) ?></div>
            </div>
        </div>
    </div>
</div>
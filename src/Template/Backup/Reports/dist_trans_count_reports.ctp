<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DealerTemp[]|\Cake\Collection\CollectionInterface $dealerTemps
 */
// echo $this->Html->script('jquery-validate');
// echo $this->Html->script('custom');
// echo $this->Html->script('formValidation');
// echo $this->Html->script('validate');
echo $this->Html->script('monthpicker.min');
echo $this->Html->css('monthpicker.css');
?>
<style type="text/css">
    .btnContainer{
        margin-right: -120px;
        margin-bottom: 10px;
    }
    .inputErrBorder{
        border: 1px solid #ff0000 !important;
    }
    .frm_error{
        font-style: italic;
        color: #ff0000;
    }
    #btnSubmit{
        float: right;
        margin-top: 15px;
    }
    .distButton {
        cursor: pointer;
        color: #0804ff;
        font-weight: 700;
    }
    .btnDeco {
        margin-top: 19px;
    }
    .bg-primary {
        background-color: #65a13f!important;
    }
    b, strong {
        font-weight: bolder;
        border-bottom-style: solid;
    }

    /*header stick*/
    thead tr:first-child th {
        position: sticky;
        top: 0;
    }
    thead tr:nth-child(2) th {
        position: sticky;
        top: 48px;
    }
    th{
        background-color: darkcyan; color: white;
    }

    /*excel*/
    img.suk_st {
        display: inline-block;
        float: right;
        margin: -12px 2px 0px 0px;
        cursor: pointer;
        height: 36px;
    }

    .required:after {
        content: " *";
        color: red;
    }

    /* y-scroll*/
    /*.tabb {
        width: 100%;
        height: 100%;
        overflow-y: hidden;
    }*/

    /*Sticky work*/
    /*.stk{
        !*background-color: gold;*!
        font-weight:700;
        position: sticky;
        left: 0;
    }*/
    /*header stick*/
    /*header stick*/
    thead tr:first-child th {
        position: sticky;
        top: 0;
    }
    thead tr:nth-child(2) th {
        position: sticky;
        top: 40px;
    }
    th{
        background-color: darkcyan;
        color: white;
        font-size: 11px;
        font-weight: 700;
    }

    /*th{
        background-color: darkcyan;
        color: white;
        font-size: 11px;
        font-weight: 700;
    }*/

    /*th {*/
    /*     padding: 5px;*/
    /*     background-color: #4cb96b;*/
    /*     position: -webkit-sticky;*/
    /*     position: sticky;*/
    /*     top: 0;*/
    /* }*/
</style>
<div class="container">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div style="width:100%;">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="border:none;">
                    <div class="card-header bg-primary text-white"><b>DISTRICT WISE TRANSACTION COUNT REPORT</b></div>
                    <fieldset>
                        <?php echo $this->Form->create('districtFrm',['name'=>'districtFrm','id'=>'districtFrm','url'=>['controller'=>'Reports','action'=>'distTransCountReports']]) ?>
                        <div class="row" style="margin-top: 18px;">
                            <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12" style="margin-left: 26%;">
                                <div class="form-group" >
                                    <label for="form"><b class="required">Month/Year :</b></label>
                                    <?php echo $this->Form->control('mnthYr', ['label' => '','empty'=>'--Select Month Year--', 'class' => 'form-control inpBx', 'id' => 'demo-1']); ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                                <div class="form-group btnDeco">
                                    <button class="btn btn-outline-success" style="">Search</button>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <?php if($this->getRequest()->is('post')) { ?>
                            <small><span style="color: red; font-weight: bold;">Note:</span> District Name is a link click for more Details.</small>
                            <small style="color: red; font-weight: 700; margin-left: 15px;">State:</small><small style="font-weight: bold"> Jharkhand</small>
                            <!--                            <small style="color: red; font-weight: 700; margin-left: 15px;">Month/Year:</small><small style="font-weight: bold">--><?php //echo $monthId."/".$yearId ?><!--</small>-->
                            <small style="color: red; font-weight: 700; margin-left: 15px;">Month/Year: </small><small style="font-weight: bold">
                                <?php
                                $mt = explode("/",$mnthYr);
                                $yr = $mt[0];
                                $my = $mt[1];
                                echo date("F", mktime(0, 0, 0, $yr, 10)) . " dist_trans_count_reports.ctp" .$my;
                                ?>
                            </small>
                            <span data-toggle="tooltip" data-placement="top" title="Download as Excel" onClick = "table_excel('exclDnld', 'Report');"><img src="../webroot/img/excle.png" class="suk_st"></span>
                            <div class="tabb">
                                <div>
                                    <?php echo $this->Form->create('districtDetail',['name'=>'districtDetail','id'=>'districtDetail','url'=>['controller'=>'Reports','action'=>'blkTransCountReports']]) ?>
                                    <table class="table table-striped table-bordered" id="exclDnld">
                                        <thead align="center">
                                        <tr>
                                            <th>#</th>
                                            <th>District Name</th>
                                            <th>NFSA Distribution</th>
                                            <th>White Distribution</th>
                                            <th>Green Distribution</th>
                                            <th>Portability In District</th>
                                            <th>Portability In State</th>
                                            <th>Impds In Jharkhand</th>
                                            <th>Impds Out Jharkhand</th>
                                            <th>UID Distribution</th>
                                            <th>OTP DIstribution</th>
                                            <th>Apwaad DIstribution</th>
                                        </tr>
                                        </thead>
                                        <tbody align="center" >
                                        <?php
                                        $SlNo = 1;
                                        $nfsa = 0;
                                        $whiteDist = 0;
                                        $green = 0;
                                        $portIn = 0;
                                        $portOut = 0;
                                        $impdsIn = 0;
                                        $impdsOut = 0;
                                        $uid = 0;
                                        $otp = 0;
                                        $apwad = 0;
                                        foreach($distCount as $dKey => $dVal){
                                            $distCode = $dVal['rgi_district_code'];
                                            ?>
                                            <tr>
                                                <td class=""><?php echo $SlNo;?></td>
                                                <td>
                                                    <span class="distButton" onclick="javascript:submitFrm('<?php echo $distCode;?>')"><?php echo $dVal['name'];?></span>
                                                </td>
                                                <td><?php echo $dVal['nfsa_distribution'] ?></td> <!-- For Dealer Count-->
                                                <td><?php echo $dVal['white_distribution'] ?></td>
                                                <td><?php echo $dVal['green_distribution'] ?></td>
                                                <td><?php echo $dVal['portable_within_district'] ?></td>
                                                <td><?php echo $dVal['portable_within_state'] ?></td>
                                                <td><?php echo $dVal['impds_in_jharkhand'] ?></td>
                                                <td><?php echo $dVal['impds_out_jharkhand'] ?></td>
                                                <td><?php echo $dVal['uid_distribution'] ?></td>
                                                <td><?php echo $dVal['otp_distribution'] ?></td>
                                                <td><?php echo $dVal['apwad_distribution'] ?></td>
                                            </tr>
                                            <?php
                                            $SlNo++;
                                            // for total
                                            $nfsa =  $nfsa + $dVal['nfsa_distribution']; // for Dealer counts
                                            $whiteDist =  $whiteDist + $dVal['white_distribution'];
                                            $green =  $green + $dVal['green_distribution'];
                                            $portIn =  $portIn + $dVal['portable_within_district'];
                                            $portOut =  $portOut + $dVal['portable_within_state'];
                                            $impdsIn =  $impdsIn + $dVal['impds_in_jharkhand'];
                                            $impdsOut =  $impdsOut + $dVal['impds_out_jharkhand'];
                                            $impdsOut =  $uid + $dVal['uid_distribution'];
                                            $otp =  $otp + $dVal['otp_distribution'];
                                            $apwad =  $apwad + $dVal['apwad_distribution'];
                                        }
                                        ?>
                                        <tr style="background-color: darkcyan; color: white;font-weight: bold">
                                            <td colspan="2">Total</td>
                                            <td><?php echo $nfsa;?></td>
                                            <td><?php echo $whiteDist;?></td>
                                            <td><?php echo $green;?></td>
                                            <td><?php echo $portIn;?></td>
                                            <td><?php echo $portOut;?></td>
                                            <td><?php echo $impdsIn;?></td>
                                            <td><?php echo $impdsOut;?></td>
                                            <td><?php echo $impdsOut;?></td>
                                            <td><?php echo $otp;?></td>
                                            <td><?php echo $apwad;?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                    echo $this->Form->hidden('rgi_dist_code',['name'=>'rgi_dist_code','id'=>'rgi_dist_code']);
                                    echo $this->Form->hidden('month_id',['name'=>'month_id','id'=>'month_id','value'=>$monthId]);
                                    echo $this->Form->hidden('year_id',['name'=>'year_id','id'=>'year_id','value'=>$yearId]);
                                    echo $this->Form->hidden('mntYr',['name'=>'mnthYr','id'=>'mnthYr','value'=>$mnthYr]);
                                    echo $this->Form->end();
                                    ?>
                                </div>
                            </div>
                        <?php }else {
                            echo "";
                        } ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function submitFrm(distCode){
        //alert(distCode);return false;
        document.getElementById('rgi_dist_code').value = distCode;
        document.getElementById('districtDetail').submit();
    }

    $('#demo-1').Monthpicker();

    // print excel document----------------------------------------------------------------------------
    var table_excel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
            ,
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->' +
                '</head><body><table>{table}</table></body></html>'
            , base64 = function (s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            }
            , format = function (s, c) {
                return s.replace(/{(\w+)}/g, function (m, p) {
                    return c[p];
                })
            }
        return function (table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()

    //    pdf download
    function print_pdf(divName){
        var printContents = $(".currentTime").val()+document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        window.location.reload();
        document.body.innerHTML = originalContents;
    }
</script>

<style>
    @page {
        header: html_pageHeader;
        footer: html_pageFooter;
        margin-top: 40mm;
        margin-bottom: 5%;
        margin-header: 5mm;
        margin-footer: 5mm;
    }
    
    .header-border {
        border-left: 1px solid #7a7a7a;
        border-right: 1px solid #7a7a7a;
        border-top: 1px solid #7a7a7a;
        height: 100%;
        /* border-bottom: 1p x dashed #7a7a7a; */
        /* padding-bottom: 50px; */
        /* margin-bottom: 86px; */
    }
    .footer-border {
        border-left: 1px solid #7a7a7a;
        border-right: 1px solid #7a7a7a;
        /* border-top: 1px dashed #7a7a7a; */
        border-bottom: 1px solid #7a7a7a;
    }
    .report-title {
        text-align: center;
        /* color: #333; */
        font-size: 16px;
        margin-top: 20px;
        padding-bottom: -20px;
        color: black;
    }
    .koperasi-name {
        text-align:center;
        padding-bottom: -15px;
        font-size: 11px;
        /* color: black; */
    }
    .koperasi-detail {
        text-align:center;
        padding-bottom: -15px;
        font-size: 10px;
    }
    </style>
    <htmlpageheader name="pageHeader">
        <div class="header-border" style="color: black">
            <h3 class="koperasi-name">{{ option('nama') ?? '' }}</h3>
            <p class="koperasi-name">{{ option('alamat') ?? '' }}, {{ option('kode_pos') ?? '' }}, {{ option('kabupaten') ?? '' }}, {{ option('provinsi') ?? '' }} </p>
            <p class="koperasi-name">Tel: {{ option('no_telepon') ?? ''}}  |  {{ !empty(option('fax')) ? 'Fax:'.option('fax').'  |' : '' }}  E-mail: {{ option('email') ?? ''}} </p>
            <h5 class="report-title"><strong>{{ $title ?? '' }}</strong></h5>
        </div>
    </htmlpageheader>
    
    <sethtmlpageheader name="pageHeader" page="0" value="0" show-this-page="1"/>
    
    <sethtmlpagefooter name="pageFooter" page="0" value="0" show-this-page="1"/>
<?php

function dateFormat($date){
    
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
}

function getFile($path){

    return "https://isport-india.s3.ap-south-1.amazonaws.com/".$path;
}
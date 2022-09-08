<?php


function successResponse($data=null,$message="data loaded successfully",$status_code=200)
{
$response=[
    'status'  => true,
    'data'    =>$data,
    'message' => $message
];
return response()->json($response,$status_code);
}


function errorResponse($data=null,$message="error happened",$status_code=404)
{
$response=[
    'status'  => false,
    'data'    =>$data,
    'message' => $message
];
return response()->json($response,$status_code);
}

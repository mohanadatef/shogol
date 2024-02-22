<?php
/**
 * @Target  this file to make enum for all system
 * @note can call it in all system if give it key we return only we send
 */
/**
 * @Target this all type media in system
 * avatar @uses  user , image
 * file @uses   user , ad , task
 * document @uses  ad , task , user
 * logo @uses social , nationality , setting
 */
function mediaType()
{
    return ['am' => 'avatar', 'fm' => 'file', 'dm' => 'document', 'lm' => 'logo','im' => 'image','dcm'=>'done','cm'=>'cover'];
}

/**
 * @Target this skills type user choose it
 */
function skillType()
{
    return ['ls' => 'language', 'ss' => 'skill', 'cs' => 'certificate'];
}

/**
 * @Target this commit type
 * cansel @uses  ad , task
 * reject approve @uses  user , ad , task
 */
function commentType()
{
    return ['rac' => 'rejectApprove', 'ac' => 'cansel','cc'=>'comment','dc'=>'doneComment'];
}

/**
 * @Target this path type we can save in it
 * images @uses user , setting , social , nationality
 * uploads @uses user , ad , task
 */
function pathType()
{
    return ['ip' => 'images', 'up' => 'uploads'];
}

/**
 * @Target this all type for approve
 * use @uses user
 */
function approveType()
{
    return ['aa' => 'accept', 'ra' => 'reject', 'wa' => 'wait'];
}

/**
 * @Target this all status for approve
 * accept @uses user @note admin accept
 * reject @uses user @note admin reject
 * wait @uses user @note wait admin to see it
 */
function approveStatusType()
{
    return ['aa' => 1, 'ra' => 2, 'wa' => 0];
}

/**
 * @Target this all status for all system
 * @note 1 : active
 * @note 0 : un active
 * @uses user , country , category , city , state , social , gender , jobName , nationality , forgotPassword ,checkMobile , language
 */
function activeType()
{
    return ['as' => 1, 'us' => 0];
}

/**
 * @Target this all status
 * @uses log
 * view @note when open page in system
 * create @note when store new row in database for anything in system
 * update @note when edit in row in database for anything in system
 * generate code @note for forget password and check mobile to check it
 * reset password @note forget password for user
 * change status @note when change status anything in system
 * login @note when user login to system
 * logout @note when user logout for system
 * add Offer @note when user add Offer in task
 * edit Offer @note when user edit Offer in task
 */
function actionType()
{
    return ['va' => 'view', 'ca' => 'create', 'ua' => 'update', 'gca' => 'generate code', 'rpa' => 'reset password', 'sa' => 'change status', 'coa' => 'convert',
        'la' => 'login', 'loa' => 'logout', 'aa' => 'approve', 'uaa' => 'un approve', 'vea' => 'verified','da'=>'delete',
    'pa'=>'problem','csa'=>'cansel','read'=>'read notification','sea'=>'search','ssea'=>'save_search'];
}

/**
 * @Target all work  it
 * offline @note wil choose country , city , state , address @if online without anything
 * @uses ad , task
 */
function workType()
{
    return ['on' => 'online', 'of' => 'offline'];
}

/**
 * @Target status
 * @uses ad , task
 * 1 @note new @note when create one
 * 2 @note open @note when admin show it
 * 3 @note active @note when admin approve it to show in system
 * 4 @note in process @note when user work in it
 * 5 @note done @note when user make it
 * 6 @note un approve by client @note when user un approve to done it
 * 7 @note cansel @note when user cansel it and make it hidden from system
 * 8 @note un approve @note whn admin not accept it
 * 9 @note time out @note when setting make it un approve automatic to make it new
 * 10 @note unApprove by freelancer @note when user un approve work in it
 * 11 @note edit Offer @note when user ask to edit price or time it
 * 11 @note done freelancer @note when user hind his done task
 */
function statusType()
{
    //1=>new
    //2=>open
    //3=>active
    //4=>in process
    //5=>done cilent
    //6=>un approve by client
    //7=>cansel
    //8=>un approve by admin
    //9=>time out
    //10=>unapprove by freelancer
    //11=>edit Offer
    //12=>done freelancer
    //13=>done admin
    return ['ns' => 1, 'os' => 2, 'as' => 3, 'is' => 4, 'ds' => 5, 'ucs' => 6,
        'cs' => 7, 'us' => 8, 'ts' => 9, 'ufs' => 10, 'es' => 11,'dfs'=>12,'dds'=>13];
}

/**
 * @Target all type task
 * @uses task
 * general @note when user ask client to do it
 * special @note when client @ask user to make something
 */
function taskType()
{
    return ['gt' => 'general', 'st' => 'special'];
}

function permissionGroup()
{
    return ['syp'=>'system','ap'=>'acl','cp'=>'core_data','sp'=>'setting','tp'=>'task'];
}

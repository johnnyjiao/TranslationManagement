<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\Admin\TranslateService;

use App\Http\Requests\TranslateCreateRequest;
use App\Http\Requests\TranslateUpdateRequest;

/**
 * 开始翻译  控制器
 */
class TranslateController extends Controller
{

    protected $translateService;

    /**
     * 构造方法
     * @author Yusure  http://yusure.cn
     * @date   2017-11-03
     * @param  [param]
     */
    public function __construct( TranslateService $translateService )
    {
        $this->translateService = $translateService;
    }

    /**
     * 待翻译列表
     * @author Yusure  http://yusure.cn
     * @date   2017-11-03
     * @param  [param]
     * @return [type]     [description]
     */
    public function index()
    {
        return view( 'admin.translate.list' );
    }

    /**
     * ajax 获取数据
     */
    public function ajaxIndex()
    {
        $responseData = $this->translateService->ajaxIndex();
        return response()->json( $responseData );
    }

    /**
     * 开始翻译
     */
    public function start( $id )
    {
        $source = $this->translateService->getTranslateSource( $id );
        // var_dump( $source->toArray() );die;
        return view( 'admin.translate.start', compact( 'source' ) );
    }

    /**
     * 完成翻译
     */
    public function finish( ProjectUpdateRequest $request, $id )
    {
        $project = $this->translateService->updateProject( $request->all(), $id );
        return redirect( 'admin/translate' );
    }

}
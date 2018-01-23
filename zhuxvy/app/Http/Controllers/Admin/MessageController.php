<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DB;

class MessageController extends IndexController
{
	public function index()
	{
        $message = DB::table('message')->paginate(15);
        foreach ($message as $key => $val) {
        	$message[$key]->uid = DB::table("qq_user")->where("qqid",$val->meuid)->select("qqnickname")->first()->qqnickname;
        }
        
      
		// return view('admin.category.category',['category'=>$category]);
        return view('admin.message.message',compact('message'));
	}

    /**
     * 从存储器中移除指定文章
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (DB::table("message")->where('mepid',$id)->first())
            return $this->json_error("请先删除此评论下的评论,删除失败","",301);

        $list = DB::table("message")->where('meid',$id)->delete();
        if ($list) {
            return $this->json_success("删除成功");
        }else{
            return $this->json_error("删除失败");
        }
    }

    public function status(Request $request)
    {
    	$data = $request->all();
    	$status['mestatus'] = 2;
    	if (!empty($data['status']))
    		$status['mestatus'] = 1;
    	
    	$list = DB::table("message")->where('meid',$data['id'])->update($status);
    	if ($list) {
    		return $this->json_success("修改成功");
    	}else{
    		return $this->json_error("修改失败");
    	}
    }
}

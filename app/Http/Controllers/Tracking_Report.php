<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\TrackingReport;
use App\Models\Track_status;
use App\Models\Country;
use Auth;
use App\Models\User;
use PDF;

class Tracking_Report extends Controller
{



    public function index(){

        $Tracking = Tracking::orderBy('id','asc')->get();
        $Track_status=Track_status::orderBy('id','asc')->get();

        return view('reports.tracking_report',compact('Tracking','Track_status'));

       }

       public function Search_tracking(Request $request){
        $Track_status=Track_status::orderBy('id','asc')->get();
        $Tracking = Tracking::orderBy('id','asc')->select('*')->where('tacking_status_id','=',$request->type)->get();
      //  $request->validate([
        //    'from'  =>'required|date|date_format:Y-m-d',
         //   'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
      //  ],[
         //   'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
          //  'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
          //  'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
      //  ]);


        if ($request->type && $request->from =='' && $request->to ==''){

           // if($request->type ) {

            $Tracking = Tracking::orderBy('id','asc')->select('*')->where('tacking_status_id','=',$request->type)->get();
            $type = $request->type;

            return view('reports.tracking_report',compact('type','Tracking','Track_status'))->withDetails($Tracking);
         }

         // في حالة تحديد
         else {

           $start_at = date($request->from);
           $end_at = date($request->to);
           $type = $request->type;
           $Track_status=Track_status::orderBy('id','asc')->get();
           $Tracking = Tracking::orderBy('id','asc')->whereBetween('created_at', [$start_at, $end_at])->where('tacking_status_id','=',$request->type)->get();

           //$Tracking = Tracking::orderBy('id','asc')->whereBetween('created_at',[$start_at,$end_at])->where('tacking_status_id','=',$request->type)->get();
           return view('reports.tracking_report',compact('type','start_at','end_at','Track_status'))->withDetails($Tracking);

         }



     }





      /*  $ids = DB::orderBy('id','asc')->table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::orderBy('id','asc')->whereIn('section_id', $ids)->get();

   if($request->student_id == 0){

       $Students = Attendance::orderBy('id','asc')->whereBetween('attendence_date', [$request->from, $request->to])->get();
       return view('pages.Teachers.dashboard.students.attendance_report',compact('Students','students'));
   }

   else{

       $Students = Attendance::orderBy('id','asc')->whereBetween('attendence_date', [$request->from, $request->to])
       ->where('student_id',$request->student_id)->get();
       return view('pages.Teachers.dashboard.students.attendance_report',compact('Students','students'));


   }  */












     /*  $rdio = $request->rdio;


    // في حالة البحث بنوع الفاتورة

       if ($rdio == 1) {


    // في حالة عدم تحديد تاريخ
           if ($request->type && $request->start_at =='' && $request->end_at =='') {

              $Tracking = Tracking::orderBy('id','asc')->select('*')->where('tacking_status_id','=',$request->type)->get();
              $type = $request->type;
              return view('reports.tracking_report',compact('type'))->withDetails($Tracking);
           }

           // في حالة تحديد تاريخ استحقاق
           else {

             $start_at = date($request->start_at);
             $end_at = date($request->end_at);
             $type = $request->type;

             $Tracking = Tracking::orderBy('id','asc')->whereBetween('created_at',[$start_at,$end_at])->where('tacking_status_id','=',$request->type)->get();
             return view('reports.tracking_report',compact('type','start_at','end_at'))->withDetails($Tracking);

           }



       }

   //====================================================================

   // في البحث برقم الفاتورة
       else {

        $Tracking = Tracking::orderBy('id','asc')->select('*')->where('tracking_number','=',$request->invoice_number)->get();
           return view('reports.tracking_report')->withDetails($Tracking);

       }



       } */

   public function Report(){





    $Tracking = Tracking::orderBy('id','asc')->get();
    $TrackingReport =  TrackingReport::orderBy('id','asc')->get();
    return view('reports.report-number',compact('Tracking','TrackingReport'));

   }



   public function SearchTrackNumber(Request $request){
        $trackcod=Tracking::where('tracking_number',$request->tracking_number)->firstOrFail();

       if (!auth()->guard('client')->check()) {
           $TrackingReport = TrackingReport::orderBy('id', 'asc')->select('*')->where('tracking_number', '=', $request->tracking_number)->get();
           $TrackingRe = TrackingReport::orderBy('id', 'asc')->select('tracking_number')->where('tracking_number', '=', $request->tracking_number)->first();
       }else{
           $track=Tracking::where('tracking_number',$request->tracking_number)->where('code_number',auth('client')->user()->code_number)->first();
           if ($track) {
               $TrackingReport = TrackingReport::orderBy('id', 'asc')->select('*')->where('tracking_number', '=', $request->tracking_number)->get();
               $TrackingRe = TrackingReport::orderBy('id', 'asc')->select('tracking_number')->where('tracking_number', '=', $request->tracking_number)->first();
           }else{
               $TrackingReport = [];
               $TrackingRe = [];
           }
       }
    return view('reports.report-number',compact('trackcod'))->withDetails($TrackingReport,$TrackingRe);




   // $TrackingReport = TrackingReport::orderBy('id','asc')->select('*')->where('tacking_status_id','=',$request->type)->get();
   // $request->validate([
     //   'from'  =>'required|date|date_format:Y-m-d',
    //    'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
   // ],[
    //    'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
    //    'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
    //    'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
   // ]);


   // if ($request->type && $request->start_at =='' && $request->end_at ==''){

        if($request->type ) {

        $TrackingReport =  TrackingReport::orderBy('id','asc')->select('*')->where('tracking_number','=',$request->type)->get();
        $type = $request->type;

        return view('reports.report-test',compact('type','TrackingReport'))->withDetails($TrackingReport);
     }

     // في حالة تحديد تاريخ استحقاق
     else {

       $start_at = date($request->start_at);
       $end_at = date($request->end_at);
       $type = $request->type;

       $Tracking = Tracking::orderBy('id','asc')->whereBetween('created_at',[$start_at,$end_at])->where('tacking_status_id','=',$request->type)->get();
       return view('reports.tracking_report',compact('type','start_at','end_at'))->withDetails($Tracking);

     }



 }




 public function TrackReportPdf(Request $request){


    $TrackingReport =  TrackingReport::orderBy('id','asc')->select('tracking_number')->where('tracking_number',$request->tracking_number)->get();
    // $data['details'] = TrackingReport::orderBy('id','asc')->with(['user','status','Country','tracktype'])->where('id',$id)->get();
    $data['details'] = $TrackingReport;
  //  $data['details'] = TrackingReport::orderBy('id','asc')->with(['user','status','Country','tracktype'])->where('id',$id)->get();
     $pdf = PDF::loadView('tracking.pdf.report', $data);
     $pdf->SetProtection(['copy', 'print'], '', 'pass');
     return $pdf->stream('report.pdf');
  }






}

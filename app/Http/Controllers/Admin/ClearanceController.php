<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;
class ClearanceController extends Controller
{
   public function clearance()
   {
       $clearance = Clearance::with('country', 'jobClearances.jobManagement', 'candidateClearances')
           ->latest()
           ->get();
       return view('admin.pages.clearance.clearance', compact('clearance'));
   }


   public function applicationSign($id)
   {
       $clearance = Clearance::where('id', $id)->first();
       //dd($clearance);
       return view('admin.pages.clearance.clearanceApproved', compact('clearance'));
   }

    public function applicationSignUpdate(Request $request, $id)
    {
        //dd($request->all());
        try {

            // File Uploads
            $sectionSign = $request->hasFile('section_sign') ?
                $request->file('section_sign')->store('sign/section/', 'public') :
                null;

            $translatorSign = $request->hasFile('translator_sign') ?
                $request->file('translator_sign')->store('sign/translator/', 'public') :
                null;

            $adSign = $request->hasFile('ad_sign') ?
                $request->file('ad_sign')->store('sign/ad/', 'public') :
                null;

            $ddSign = $request->hasFile('dd_sign') ?
                $request->file('dd_sign')->store('sign/dd/', 'public') :
                null;

            $dSign = $request->hasFile('d_sign') ?
                $request->file('d_sign')->store('sign/d/', 'public') :
                null;

            $adgSign = $request->hasFile('adg_sign') ?
                $request->file('adg_sign')->store('sign/adg/', 'public') :
                null;

            $dgSign = $request->hasFile('dg_sign') ?
                $request->file('dg_sign')->store('sign/dg/', 'public') :
                null;

            $clearance = Clearance::findOrFail($id);
            $clearance->section_name = $request->input('section_name');
            $clearance->section_approved_status = ($request->input('section_approved_status') === '1') ? 1 : 0;
            $clearance->section_date = $request->input('section_date');

            $clearance->translator_name = $request->input('translator_name');
            $clearance->translator_approved_status = ($request->input('translator_approved_status') === '1') ? 1 : 0;
            $clearance->translator_date = $request->input('translator_date');

            $clearance->ad_name = $request->input('ad_name');
            $clearance->ad_approved_status = ($request->input('ad_approved_status') === '1') ? 1 : 0;
            $clearance->ad_date = $request->input('ad_date');

            $clearance->dd_name = $request->input('dd_name');
            $clearance->dd_approved_status = ($request->input('dd_approved_status') === '1') ? 1 : 0;
            $clearance->dd_date = $request->input('dd_date');

            $clearance->d_name = $request->input('d_name');
            $clearance->d_approved_status = ($request->input('d_approved_status') === '1') ? 1 : 0;
            $clearance->d_date = $request->input('d_date');

            $clearance->adg_name = $request->input('adg_name');
            $clearance->adg_approved_status = ($request->input('adg_approved_status') === '1') ? 1 : 0;
            $clearance->adg_date = $request->input('adg_date');

            $clearance->dg_name = $request->input('dg_name');
            $clearance->dg_approved_status = ($request->input('dg_approved_status') === '1') ? 1 : 0;
            $clearance->dg_date = $request->input('dg_date');

            // Update file paths only if a new file is uploaded
            if ($request->hasFile('section_sign')) {
                $clearance->section_sign = $sectionSign;
            } elseif ($request->input('section_sign')) {
                $clearance->section_sign = $request->input('section_sign');
            }

            if ($request->hasFile('translator_sign')) {
                $clearance->translator_sign = $translatorSign;
            } elseif ($request->input('translator_sign')) {
                $clearance->translator_sign = $request->input('translator_sign');
            }

            if ($request->hasFile('ad_sign')) {
                $clearance->ad_sign = $adSign;
            } elseif ($request->input('ad_sign')) {
                $clearance->ad_sign = $request->input('ad_sign');
            }

            if ($request->hasFile('dd_sign')) {
                $clearance->dd_sign = $ddSign;
            } elseif ($request->input('dd_sign')) {
                $clearance->dd_sign = $request->input('dd_sign');
            }

            if ($request->hasFile('d_sign')) {
                $clearance->d_sign = $dSign;
            } elseif ($request->input('d_sign')) {
                $clearance->d_sign = $request->input('d_sign');
            }

            if ($request->hasFile('adg_sign')) {
                $clearance->adg_sign = $adgSign;
            } elseif ($request->input('adg_sign')) {
                $clearance->adg_sign = $request->input('adg_sign');
            }

            if ($request->hasFile('dg_sign')) {
                $clearance->dg_sign = $dgSign;
            } elseif ($request->input('dg_sign')) {
                $clearance->dg_sign = $request->input('dg_sign');
            }
            $clearance->save();
            Toastr::success('Clearance updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }

    }

}

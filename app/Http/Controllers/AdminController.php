<?php
//Author: Loh Wei Sheng
namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {

    public function AdminLogout() {
        Auth::logout();
        session()->flush();
        return Redirect()->route('login');
    }

//end method

    public function UserProfile(Request $request) {
        $adminData = Auth::user();
        return view('backend.admin.admin_profile', compact('adminData'));
    }

    public function UpdateProfile() {
        return redirect()->route('profile.show');
    }

    public function addNewAdmin() {
        $adminData = Auth::user();
        return view('backend.admin.admin_addNew', compact('adminData'));
    }

    public function storeNewAdmin(Request $request) {
        $newAdmin = new CreateNewUser();
        $admin = $newAdmin->create($request->only(['name', 'email', 'roleID', 'password', 'password_confirmation']));

        $request->session()->flash('success', 'You have created the admin');
        return redirect()->route('add.admin');
    }

    public function DownloadAdminListXML()
    {
        $filepath = public_path()."/xml/adminList.xml";

        return response()->download($filepath); 
    }

    public function getAllAdmin() {
        $adminList = User::all()->where('roleID', 2);

        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument();

        // Start a element to put data in
        $xml->startElement('User');
        // Data what goes in your element\
        foreach ($adminList as $admin) {
            $xml->startElement('Admin');
            $xml->startElement('id');
            $xml->writeRaw($admin->id);
            $xml->endElement();

            $xml->startElement('name');
            $xml->writeRaw($admin->name);
            $xml->endElement();

            $xml->startElement('email');
            $xml->writeRaw($admin->email);
            $xml->endElement();

            $xml->startElement('profile_photo_path');
            $xml->writeRaw($admin->profile_photo_path);
            $xml->endElement();

            $xml->startElement('roleID');
            $xml->writeRaw($admin->roleID);
            $xml->endElement();

            $xml->startElement('created_at');
            $xml->writeRaw($admin->created_at);
            $xml->endElement();

            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();

        // You put the XML content in this variable
        $contents = $xml->outputMemory();
        // Reset XML just in case
        $xml = null;

        if (!Storage::disk('public_uploads')->put('adminList.xml', $contents)) {
            return false;
        }

        //Display
        $dom = new \DOMDocument();
        $path = 'app/public/xml/adminList.xml';
        $xslPath = 'app/public/xml/adminList.xsl';
         
        if (Storage::disk('public_uploads')->exists('adminList.xml')) {
            $xml_doc = new \DOMDocument();
            $xml_doc->load(public_path('xml/adminList.xml'));
            $xsl_doc = new \DOMDocument();
            $xsl_doc->load(public_path('xml/adminList.xsl'));
            $proc = new \XSLTProcessor();
            $proc->importStylesheet($xsl_doc);
            $new_xml_doc = $proc->transformToXML($xml_doc);
            $data['new_xml_doc'] = $new_xml_doc;
        } else {
            $data['new_xml_doc'] = "<span class = 'alert alert-info'>Admin List Not Found!!</span>";
        }

        return view('backend.admin.admin_list', compact('data'));
    }
    public function DownloadCustomerListXML()
    {
        $filepath = public_path()."/xml/customerList.xml";

        return response()->download($filepath); 
    }

    public function getAllCustomer() {
        $customerList = User::all()->where('roleID', 1);

        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument();

        // Start a element to put data in
        $xml->startElement('User');
        // Data what goes in your element\
        foreach ($customerList as $cust) {
            $xml->startElement('Customer');
            $xml->startElement('id');
            $xml->writeRaw($cust->id);
            $xml->endElement();

            $xml->startElement('name');
            $xml->writeRaw($cust->name);
            $xml->endElement();

            $xml->startElement('email');
            $xml->writeRaw($cust->email);
            $xml->endElement();

            $xml->startElement('profile_photo_path');
            $xml->writeRaw($cust->profile_photo_path);
            $xml->endElement();

            $xml->startElement('roleID');
            $xml->writeRaw($cust->roleID);
            $xml->endElement();

            $xml->startElement('created_at');
            $xml->writeRaw($cust->created_at);
            $xml->endElement();

            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();

        // You put the XML content in this variable
        $contents = $xml->outputMemory();
        // Reset XML just in case
        $xml = null;

        if (!Storage::disk('public_uploads')->put('customerList.xml', $contents)) {
            return false;
        }

        //Display
        $dom = new \DOMDocument();
        $path = 'app/public/xml/customerList.xml';
        $xslPath = 'app/public/xml/customerList.xsl';
         
        if (Storage::disk('public_uploads')->exists('customerList.xml')) {
            $xml_doc = new \DOMDocument();
            $xml_doc->load(public_path('xml/customerList.xml'));
            $xsl_doc = new \DOMDocument();
            $xsl_doc->load(public_path('xml/customerList.xsl'));
            $proc = new \XSLTProcessor();
            $proc->importStylesheet($xsl_doc);
            $new_xml_doc = $proc->transformToXML($xml_doc);
            $data['new_xml_doc'] = $new_xml_doc;
        } else {
            $data['new_xml_doc'] = "<span class = 'alert alert-info'>Customer List Not Found!!</span>";
        }

        return view('backend.admin.admin_customerList', compact('data'));
    }
}

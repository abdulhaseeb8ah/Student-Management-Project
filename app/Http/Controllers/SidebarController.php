<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidebarItem;

class SidebarController extends Controller
{
    /**
     * Get the sidebar items for the specified role.
     *
     * @param  string  $role
     * @return \Illuminate\Http\Response
     */
    public function getSidebarItems($role)
    {
        $sidebarItemsJson = SidebarItem::where('role', $role)->value('sidebar_items_json');
        $sidebarItems = json_decode($sidebarItemsJson, true);
        return $sidebarItems;
    }
}

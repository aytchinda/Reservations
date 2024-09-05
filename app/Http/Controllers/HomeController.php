<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  // Page publique ou d'accueil générale
  public function homepage()
  {
      // Retourner la liste des shows pour tous les utilisateurs
      $shows = Show::all();
      return view('home.index', compact('shows'));
  }

  // Méthode supplémentaire si tu as besoin d'une vue différente pour les utilisateurs authentifiés
  public function dashboard()
  {
      // Ceci pourrait être une page spécifique pour les utilisateurs authentifiés
      return view('home.dashboard');
  }
    public function search(Request $request)
    {
        $query = Show::query();

        if ($request->has('name') && $request->name != '') {
            $query->where('title', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereHas('representations', function ($q) use ($request) {
                $q->whereDate('when', $request->date);
            });
        }

        $shows = $query->get();

        return view('home.index', compact('shows'));
    }
}

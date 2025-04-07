<?php

namespace App\Livewire;

use App\Models\Researches;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowResearch extends Component
{
    public $research;
    public $research_id;

    public function mount($research_id)
    {
        $this->research_id = $research_id;
        $user = Auth::user();

        // جلب البحث من قاعدة البيانات
        $research = Researches::findOrFail($research_id);

        // السماح للمستخدم الذي لديه دور super-admin برؤية أي بحث
        if ($user->hasRole('super-admin')) {
            $this->research = $research;
            return;
        }

        // السماح فقط للمستخدم الذي لديه دور admin برؤية الأبحاث التابعة لقسمه
        if ($user->hasRole('admin') && $research->department_id === $user->department_id) {
            if (empty($research->student)) {
                return redirect()->route('admin.payments.index')->with('error', __('You don’t have permission.'));
            }
            $this->research = $research;
            return;
        }

        // رفض الوصول إذا لم تتحقق أي من الشروط أعلاه
        abort(403, __("You are not authorized"));
    }

    public function render()
    {
        return view('livewire.show-research', [
            'research' => $this->research
        ]);
    }
}

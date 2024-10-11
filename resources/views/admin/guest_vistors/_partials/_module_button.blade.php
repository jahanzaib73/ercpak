<div class="category-buttons">
    <button type="button" class="btn btn-outline-danger" onclick="showForm('OFFICIAL')" title="Add data for Official category"><i class="fa fa-plus"></i> Official</button>
    |
    <button type="button" class="btn btn-outline-danger" onclick="showForm('NOTABLE')" title="Add data for Notable category"><i class="fa fa-plus"></i> Notable</button>
    |
    <button type="button" class="btn btn-outline-danger" onclick="showForm('BUSINESS')" title="Add data for Business category"><i class="fa fa-plus"></i> Business</button>
</div>




{{-- <div>
    @if (Auth::user()->can('View By Guest'))
        <a href="{{ route('guest-and-visitors.index', ['module_name' => App\Models\GuestVistor::GUEST]) }}"
            class="btn py-2 {{ $moduleName == App\Models\GuestVistor::GUEST ? 'afterActiveColor' : 'save-btn' }}">Guest</a>
    @endif


    @if (Auth::user()->can('View By Visitors'))
        |
        <a href="{{ route('guest-and-visitors.index', ['module_name' => App\Models\GuestVistor::VISTORS]) }}"
            class="btn {{ $moduleName == App\Models\GuestVistor::VISTORS ? 'afterActiveColor' : 'save-btn' }}">Customers</a>
    @endif
</div> --}}

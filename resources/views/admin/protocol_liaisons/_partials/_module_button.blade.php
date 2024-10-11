<div class="col-8 text-right">
    @if (Auth::user()->can('View By Official'))
        <a href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::OFFICIAL]) }}"
            class="btn {{ $moduleName == App\Models\ProtocolLiaison::OFFICIAL ? 'afterActiveColor' : 'save-btn' }}">{{ App\Models\ProtocolLiaison::OFFICIAL }}</a>
    @endif
    @if (Auth::user()->can('View By Notable'))
        |
        <a href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::NOTABLE]) }}"
            class="btn {{ $moduleName == App\Models\ProtocolLiaison::NOTABLE ? 'afterActiveColor' : 'save-btn' }}">{{ App\Models\ProtocolLiaison::NOTABLE }}</a>
    @endif
    @if (Auth::user()->can('View By Company'))
        |
        <a href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::COMPANY]) }}"
            class="btn {{ $moduleName == App\Models\ProtocolLiaison::COMPANY ? 'afterActiveColor' : 'save-btn' }}">{{ App\Models\ProtocolLiaison::COMPANY }}</a>
    @endif
    @if (Auth::user()->can('View By Project'))
        |
        <a href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::PROJECT]) }}"
            class="btn {{ $moduleName == App\Models\ProtocolLiaison::PROJECT ? 'afterActiveColor' : 'save-btn' }}">{{ App\Models\ProtocolLiaison::PROJECT }}</a>
    @endif
    @if (Auth::user()->can('View By Property'))
        |
        <a href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::PROPERTY]) }}"
            class="btn {{ $moduleName == App\Models\ProtocolLiaison::PROPERTY ? 'afterActiveColor' : 'save-btn' }}">{{ App\Models\ProtocolLiaison::PROPERTY }}</a>
    @endif
</div>

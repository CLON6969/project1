@php $isEdit = isset($package); @endphp

<form action="{{ $isEdit ? route('admin.web.package.update', $package) : route('admin.web.package.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    {{-- PACKAGE FIELDS --}}
    @foreach([
        'package_tittle' => 'Package Title',
        'statement' => 'Statement',
        'tittle1' => 'Title 1',
        'tittle1_content' => 'Title 1 Content',
        'tittle2' => 'Title 2',
        'tittle2_content' => 'Title 2 Content',
        'tittle3' => 'Title 3',
        'tittle3_content' => 'Title 3 Content',
        'tittle4' => 'Title 4',
        'tittle4_content' => 'Title 4 Content',
        'tittle5' => 'Title 5',
        'tittle5_content' => 'Title 5 Content',
    ] as $field => $label)
        <div class="mb-3">
            <label for="{{ $field }}">{{ $label }}</label>
            @if(str_contains($field, 'content') || $field === 'statement')
                <textarea name="{{ $field }}" id="{{ $field }}" class="form-control">{{ old($field, $package->$field ?? '') }}</textarea>
            @else
                <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control" value="{{ old($field, $package->$field ?? '') }}">
            @endif
        </div>
    @endforeach

    {{-- PLANS SECTION --}}
    <div id="plans-wrapper">
        <h4>Plans</h4>

        @if($isEdit && $package->plans)
            @foreach($package->plans as $pIndex => $plan)
                <div class="card mb-4 plan-card" data-index="{{ $pIndex }}">
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-danger float-end" onclick="removeElement(this)">Remove Plan</button>
                        <input type="hidden" name="plans[{{ $pIndex }}][id]" value="{{ $plan->id }}">

                        @foreach([
                            'plan_tittle' => 'Plan Title',
                            'amount' => 'Amount',
                            'currency' => 'Currency',
                            'content1' => 'Content 1',
                            'titttle1' => 'Tittle 1',
                            'button1_name' => 'Button 1 Name',
                            'button1_url' => 'Button 1 URL',
                            'button2_name' => 'Button 2 Name',
                            'button2_url' => 'Button 2 URL'
                        ] as $pField => $pLabel)
                            <div class="mb-2">
                                <label>{{ $pLabel }}</label>
                                <input type="text" name="plans[{{ $pIndex }}][{{ $pField }}]" class="form-control" value="{{ old("plans.{$pIndex}.{$pField}", $plan->$pField) }}">
                            </div>
                        @endforeach

                        {{-- FEATURES --}}
                        <h6>Features</h6>
                        <div class="features-wrapper">
                            @foreach($plan->features as $fIndex => $feature)
                                <div class="input-group mb-2">
                                    <input type="hidden" name="plans[{{ $pIndex }}][features][{{ $fIndex }}][id]" value="{{ $feature->id }}">
                                    <input type="text" name="plans[{{ $pIndex }}][features][{{ $fIndex }}][name]" class="form-control" value="{{ $feature->name }}" required>
                                    <button type="button" class="btn btn-outline-danger" onclick="this.closest('.input-group').remove()">×</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addFeature(this)">+ Add Feature</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <button type="button" class="btn btn-secondary mb-3" onclick="addPlan()">+ Add Plan</button>

    <div class="mt-4">
        <button type="submit" class="btn btn-success">Save Package</button>
    </div>
</form>

{{-- Scripts --}}
<script>
    let planIndex = {{ $isEdit && $package->plans ? $package->plans->count() : 0 }};

    function addPlan() {
        const wrapper = document.getElementById('plans-wrapper');
        const html = `
            <div class="card mb-4 plan-card" data-index="\${planIndex}">
                <div class="card-body">
                    <button type="button" class="btn btn-sm btn-danger float-end" onclick="removeElement(this)">Remove Plan</button>

                    @foreach([
                        'plan_tittle' => 'Plan Title',
                        'amount' => 'Amount',
                        'currency' => 'Currency',
                        'content1' => 'Content 1',
                        'titttle1' => 'Tittle 1',
                        'button1_name' => 'Button 1 Name',
                        'button1_url' => 'Button 1 URL',
                        'button2_name' => 'Button 2 Name',
                        'button2_url' => 'Button 2 URL'
                    ] as $pField => $pLabel)
                        <div class="mb-2">
                            <label>{{ $pLabel }}</label>
                            <input type="text" name="plans[\${planIndex}][{{ $pField }}]" class="form-control">
                        </div>
                    @endforeach

                    <h6>Features</h6>
                    <div class="features-wrapper"></div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addFeature(this)">+ Add Feature</button>
                </div>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        planIndex++;
    }

    function addFeature(button) {
        const planCard = button.closest('.plan-card');
        const planIndex = planCard.dataset.index;
        const wrapper = planCard.querySelector('.features-wrapper');
        const featureCount = wrapper.querySelectorAll('.input-group').length;

        const html = `
            <div class="input-group mb-2">
                <input type="text" name="plans[\${planIndex}][features][\${featureCount}][name]" class="form-control" placeholder="Feature name" required>
                <button type="button" class="btn btn-outline-danger" onclick="this.closest('.input-group').remove()">×</button>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
    }

    function removeElement(button) {
        button.closest('.plan-card').remove();
    }
</script>

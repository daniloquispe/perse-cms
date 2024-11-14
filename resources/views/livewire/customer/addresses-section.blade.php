<x-customer-card title="Direcciones" :has-body="false">
	@foreach(auth('storefront')->user()->addresses()->latest()->get() as $address)
		<livewire:customer.editable-address wire:key="address-{{ $address->id }}" :address="$address" />
	@endforeach
</x-customer-card>

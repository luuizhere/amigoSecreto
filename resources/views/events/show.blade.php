<!-- resources/views/events/show.blade.php -->
<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Cabeçalho do Evento -->
            <div class="mb-8 bg-white rounded-lg shadow-sm p-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $event->name }}</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Data: {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <span class="inline-flex items-center rounded-full px-3 py-0.5 text-sm font-medium {{ $event->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $event->status === 'active' ? 'Ativo' : 'Inativo' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Seção de Participantes -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="sm:flex sm:items-center sm:justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Participantes</h2>
                    <button type="button" onclick="openPersonModal()" class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        Adicionar Participante
                    </button>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($event->people as $person)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $person->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $person->age }} anos - {{ $person->gender === 'M' ? 'Masculino' : ($person->gender === 'F' ? 'Feminino' : 'Outro') }}</p>
                            </div>
                            <button onclick="openGiftModal({{ $person->id }})" class="text-indigo-600 hover:text-indigo-900">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Lista de Presentes -->
                        @if($person->giftLinks->count() > 0)
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Lista de Presentes:</h4>
                            <div class="space-y-2">
                                @foreach($person->giftLinks as $gift)
                                <div class="flex items-start justify-between bg-white p-2 rounded">
                                    <div class="flex-1">
                                        <a href="{{ $gift->link }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 break-all">
                                            {{ $gift->link }}
                                        </a>
                                        @if($gift->observation)
                                        <p class="text-xs text-gray-500 mt-1">{{ $gift->observation }}</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('gift-links.destroy', [$person, $gift]) }}" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Novo Participante -->
    <div id="personModal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pb-4 pt-5 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <form action="{{ route('people.store', $event) }}" method="POST">
                    @csrf
                    <div>
                        <div class="mt-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-3">
                            <label for="age" class="block text-sm font-medium text-gray-700">Idade</label>
                            <input type="number" name="age" id="age" required min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-3">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gênero</label>
                            <select name="gender" id="gender" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="other">Outro</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none sm:col-start-2 sm:text-sm">
                            Adicionar
                        </button>
                        <button type="button" onclick="closePersonModal()" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none sm:col-start-1 sm:mt-0 sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Novo Presente -->
    <div id="giftModal" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pb-4 pt-5 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <form id="giftForm" method="POST">
                    @csrf
                    <div>
                        <div class="mt-3">
                            <label for="link" class="block text-sm font-medium text-gray-700">Link do Presente</label>
                            <input type="url" name="link" id="link" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-3">
                            <label for="observation" class="block text-sm font-medium text-gray-700">Observação</label>
                            <textarea name="observation" id="observation" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none sm:col-start-2 sm:text-sm">
                            Adicionar
                        </button>
                        <button type="button" onclick="closeGiftModal()" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none sm:col-start-1 sm:mt-0 sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openPersonModal() {
            document.getElementById('personModal').classList.remove('hidden');
        }

        function closePersonModal() {
            document.getElementById('personModal').classList.add('hidden');
        }

        function openGiftModal(personId) {
            const modal = document.getElementById('giftModal');
            const form = document.getElementById('giftForm');
            form.action = `/people/${personId}/gift-links`;
            modal.classList.remove('hidden');
        }

        function closeGiftModal() {
            document.getElementById('giftModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
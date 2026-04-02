<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12 mb-5">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    {{--  --}}
                    <section>
                        <header class="flex justify-between">
                            <div>

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Liste des clients') }}
                                </h2>
                                
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Bonjour ') }}
                                </p>
                            </div>

                            <div>
                                <x-primary-button> Ajouter </x-primary-button>
                            </div>

                        </header>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    <section>
                           <table class="text-lg font-medium text-gray-900 dark:text-gray-100 w-full">
                            <thead>
                                <tr>
                                    <th class="p-4">#</th>
                                    <th class="p-4">Nom</th>
                                    <th class="p-4">Prenoms</th>
                                    <th class="p-4">Telephone</th>
                                    <th class="p-4">Email</th>
                                    <th class="p-4">Etat</th>
                                    <th class="p-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-4"> bonjour </td>
                                    <td class="p-4"> bonjour </td>
                                    <td class="p-4"> bonjour </td>
                                    <td class="p-4"> bonjour </td>
                                    <td class="p-4"> bonjour </td>
                                    <td class="p-4"> bonjour </td>
                                    <td class="p-4"> 
                                        <x-primary-button> Action </x-primary-button>
                                        <x-primary-button> Action </x-primary-button>
                                        <x-primary-button> Action </x-primary-button>
                                        <x-primary-button> Action </x-primary-button>
                                     </td>
                                </tr>
                            </tbody>
                           </table>
                    </section>
                </div>
            </div>
        </div>

       

        
    </div>

    
</x-app-layout>
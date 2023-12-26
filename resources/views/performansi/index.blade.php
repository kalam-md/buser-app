<x-app-layout>
  <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
          {{ __('Data Performansi') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200 lg:p-8">
                  <div class="sm:flex sm:items-center">
                      <div class="sm:flex-auto">
                          <h1 class="text-2xl font-medium text-gray-900">
                              Tabel performansi
                          </h1>
                      </div>
                      @if (Auth::user()->role == 'admin')
                      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                          <a href="{{ route('pemain.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Tambah Pemain</a>
                      </div>  
                      @endif
                  </div>
                  
                  {{-- table --}}
                  <div class="flex flex-col mt-8">
                      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                          <div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                              <table class="min-w-full divide-y divide-gray-300 table-fixed">
                                  <thead class="bg-gray-50">
                                      <tr>
                                          <th scope="col" class="relative w-12 px-6 text-sm font-semibold text-gray-900">No</th>
                                          <th scope="col" class="py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">Nama Pemain</th>
                                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Posisi</th>
                                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Team</th>
                                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Overall Rate</th>
                                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"></th>
                                      </tr>
                                  </thead>
                                  <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($pemains as $pemain)
                                        <tr>
                                            <td class="relative w-12 px-6 sm:w-16 sm:px-8">{{ $loop->iteration }}</td>
                                            <td class="flex items-center gap-2 py-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                <img class="rounded-full w-7" src="{{ asset('storage/' . $pemain->photo) }}" alt="{{ $pemain->nama }}">
                                                <span class="text-sm font-medium text-gray-900 whitespace-nowrap">{{ $pemain->nama }}</span>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $pemain->posisi }}</td>
                                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                @if ($pemain->team_id == null)
                                                Belum ada team
                                                @else
                                                {{ $pemain->team->nama_team }}
                                                @endif
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">-</td>
                                            <td class="py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('pemain.show', $pemain->slug) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 text-indigo-600 hover:text-indigo-900">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>  
                                                    </a> 
                                                    
                                                    <a href="{{ route('performansi.edit', $pemain->slug) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 text-green-600 hover:text-green-900">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                    </a>
    
                                                    <form action="" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="flex items-center" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6 text-red-600 cursor-pointer hover:text-red-900">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="py-4 pr-3 text-sm font-medium text-center text-gray-900 whitespace-nowrap" colspan="7">Data tidak di temukan</td>
                                        </tr>
                                    @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      </div>
                  </div>
                  {{-- end table --}}
              </div>              
          </div>
      </div>
  </div>
</x-app-layout>
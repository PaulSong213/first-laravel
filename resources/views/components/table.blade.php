<main>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
    @php
        $attributes = array_keys($datas->first()->toArray());
    @endphp
   
    <div class="flex flex-col">
      
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 px-2">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    @foreach ($attributes as $attribute)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{$attribute}}
                        </th>
                    @endforeach
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          actions
                        </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($datas as $data)
                        <tr class="whitespace-nowrap hover:bg-gray-100">
                            <div class="flex items-center">
                            @foreach ($attributes as $attribute)
                            <td class="p-4"> {{ $data->$attribute}} </td>    
                            @endforeach
                            <td class="p-4">
                              <section class="flex space-x-1">
                                 {{-- View --}}
                                 <div class="bg-blue-500 hover:bg-blue-600 text-white hover:shadow-sm transition-all rounded-lg cursor-pointer h-8 w-8 flex opacity-80">
                                  <ion-icon class="table m-auto" name="eye"></ion-icon>
                                </div>
                                {{-- Edit --}}
                                <div class="bg-green-500 hover:bg-green-600 text-white hover:shadow-sm transition-all rounded-lg cursor-pointer h-8 w-8 flex opacity-80">
                                  <ion-icon class="table m-auto" name="create"></ion-icon>
                                </div>
                                {{-- Delete --}}
                                <div class="bg-red-500 hover:bg-red-600 text-white hover:shadow-sm transition-all rounded-lg cursor-pointer h-8 w-8 flex opacity-80">
                                  <ion-icon class="table m-auto" name="trash"></ion-icon>
                                </div>

                              </section>
                            </td>  
                            </div>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</main>
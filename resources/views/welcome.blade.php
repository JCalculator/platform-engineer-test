@extends('layouts.app')

@section('title', 'Find Movies')

@section('content')
    <div class="flex mb-4 m-auto mt-5">
      <div class="w-1/2 p-10">
        <div class="text-xl font-bold mb-4 text-center">
          Find movies/shows made in ABQ
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="startDate">
              Start Date
            </label>
            <input class="form-control" id="startDate" type="date" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="endDate">
              End Date
            </label>
            <input class="form-control" id="endDate" type="date" required>
          </div>
        </div>
        <div class="text-center">
          <button id="fetchProductions" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Find Movies</button>
        </div>
        
      </div>
      <div id="productionsContainer" class="w-1/2 h-12 text-center">
      </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Request\MusicRequest;
use App\Models\Music;
use App\Models\PlayList;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PlayListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $name = $request['name'];
        $maxRecord = $request['max_items'];
        $id = $request['user_id'];


        $user = User::where(['id' => $id])->first();
        $model = new PlayList();

        if (!$user) {
            return response()->json(['message' => 'User does not exist', 'error' => true, 'code' => 401]);
        }
        if ($name && $maxRecord) {
            try {
                $model->create([
                    'name' => $name,
                    'user_id' => $id,
                    'max_items' => $maxRecord,
                ]);
                return response()->json(['message' => 'success', 'error' => false, 'code' => 200]);
            } catch (QueryException $dbExeption) {
                return response()->json(['message' => $dbExeption->getMessage(), 'error' => true, 'code' => 200]);
            }
        }
        return response()->json(['message' => 'Invalid Parameters', 'error' => true, 'code' => 401]);
    }

    public function addMusicToPlayList(MusicRequest $request, $id)
    {
        $music = new Music();
        $playList = PlayList::where(['id' => $id])->first();
        if (!$playList) {
            return response()->json(['message' => 'Play List does not exist', 'error' => true, 'code' => 401]);
        }
        try {
            $music->create([
                'playlist_id' => $playList->id,
                'music_name' => $request['music_name'],
                'music_url' => $request['music_url']
            ]);
            return response()->json(['message' => 'success', 'error' => false, 'code' => 200]);
        } catch (QueryException $dbExeption) {
            return response()->json(['message' => $dbExeption->getMessage(), 'error' => true, 'code' => 200]);
        }
    }

    public function getPlayListByUserId(Request $request)
    {
        $playLists = PlayList::where(['user_id' => $request->user_id])->get();

        return response()->json(['playLists' => $playLists]);

    }

    public function getMusicsByUserId(Request $request)
    {
        $musics = Music::select('musics.*')
            ->join('play_lists', 'musics.playlist_id', '=', 'play_lists.id')
            ->where('play_lists.user_id', '=', $request->user_id)
            ->get();

        return response()->json($musics);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $locale
     * @param int $id
     */
    public function destroy(Request $request, $id)
    {
        $playList = PlayList::where(['id' => $id])->first();
        if ($playList) {
            try {
                $playList->delete();
                return response()->json(['message' => 'success', 'error' => false, 'code' => 200]);
            } catch (QueryException $dbException) {
                return response()->json(['message' => $dbException->getMessage(), 'error' => true, 'code' => 200]);
            }
        }
        return response()->json(['message' => 'PlayList Not Found', 'error' => true, 'code' => 200]);

    }

    public function destroyMusic(Request $request, $id)
    {
        $music = Music::where(['id' => $id])->first();
        if ($music) {
            try {
                $music->delete();
                return response()->json(['message' => 'success', 'error' => false, 'code' => 200]);
            } catch (QueryException $dbException) {
                return response()->json(['message' => $dbException->getMessage(), 'error' => true, 'code' => 200]);
            }
        }
        return response()->json(['message' => 'Music Not Found', 'error' => true, 'code' => 200]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = new Comment($request->all());
        $comment->user_id = $request->user()->id;
        //送られてきたコメントとuser情報を取得

        try {
            //登録
            //$postに対するコメント($post->comments())をセーブするコード
            //リレーション設定してるからできる。$comment->post_id = $post->id 改行$comment->save()でもOK。
            $post->comments()->save($comment);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
        //catchはエラーの場合実行。通称エラーハンドリング=エラー対応。\Exceptionが例外=エラー
        //backは直前のページに戻る=エラーのページ。withInputはユーザーが入力したのを保存。
        //withErrorsはエラーのオブジェクトのエラーメッセージを取得してセッションに保存
        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'コメントを登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, Comment $comment)
    {
        //posts/{post}/comments/{comment}/edit ........................ posts.comments.edit
        //route:list --name=commentsで上記が出てくる。これはpostとcommentを取得できることを意味するため、
        //デフォルトの引数から追加する
        return view('comments.edit', compact('post', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request,  Post $post, Comment $comment)
    {
        if ($request->user()->cannot('update', $comment)) {
            return redirect()->route('posts.show', $post)
                ->withErrors('自分のコメント以外は更新できません');
        }
        $comment->fill($request->all());

        try {
            //更新
            $comment->save();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('posts.show', $post)
            ->with('notice', 'コメントを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post,Comment $comment)
    {
        try {
            $comment->delete();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('posts.show', $post)
            ->with('notice', 'コメントを削除しました');
    }
}

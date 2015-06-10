<?php
namespace AppquariumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;


trait AvatarTrait
{
    public function avatarToArray(Request $request, $name)
    {

        $avatar = $request->files->get($name);


        $avatarData = [];
        if (!is_null($avatar)) {
            $avatarData ["name"] = $avatar->getClientOriginalName();
            $avatarData ["type"] = $avatar->getMimeType();
            $avatarData ["size"] = $avatar->getClientSize();
            $avatarData ["error"] = $avatar->getError();
            $avatarData ["tmp_name"] = $avatar->getRealPath();
        }
        return $avatarData;
    }
}

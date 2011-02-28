
-- TODO - move configuration out of this file
-- TODO - load from The Tor Project's official mirror list
web_mirror_roots = {
    "http://www.torservers.net/mirrors/torproject.org/dist/",
    "http://www.torproject.org/dist/",
    "http://www.oignon.net/dist",
    "http://tor.amorphis.eu/dist/",
    "http://tor.ccc.de/dist/",
    "http://tor.idnr.ws/dist/",
    "http://cyberside.net.ee/tor/",
    "http://mirrors.chaos-darmstadt.de/tor-mirror/dist/",
    "http://www.torproject.us/dist/",
    "http://tor.beme-it.de/dist/",
    "http://torproj.xpdm.us/dist/",
    "http://tor.askapache.com/dist/",
    "http://torproject.nwlinux.us/dist/",
    "http://tor.homosu.net/dist/",
    "http://www.torproject.org.nyud.net/dist/",
    "http://tor.kamagurka.org/dist/",
    "http://theonionrouter.com/dist/",
}

-- TODO - move configuration out of this file
trackers = {
    "udp://tracker.openbittorrent.com:80/announce",
    "udp://tracker.publicbt.com:80/announce",
    "http://tracker.openbittorrent.com:80/announce",
    "http://tracker.publicbt.com:80/announce",
}

files = {}
do
    local file_list = io.popen("find . -type f", "r")

    for line in file_list:lines() do
        table.insert(files, line)
    end

    file_list.close()
end


torrents = {}

new_torrent = function(torrent_name)
    return {
        name = torrent_name,
        trackers = trackers,
        files = {},
        web_seeds = {},
    }
end

-- torrent_name *should not* have ".torrent" already appended to it!
add_file_to_torrent = function(torrent_name, file)
    local torrent = torrents[torrent_name]

    if torrent == nil then
        torrent = new_torrent(torrent_name)
        torrents[torrent_name] = torrent
    end

    table.insert(torrent.files, file)
end


torrent_namers = {}

add_torrent_namer = function(f)
    table.insert(torrent_namers, f)
end

add_filtering_torrent_namer = function(pattern, f)
    return add_torrent_namer(function(file)
        if string.find(file, pattern) then
            return f(file)
        end
    end)
end

make_gsub_func = function(pattern, repl)
    return function(s)
        return s:gsub(pattern, repl)
    end
end

compute_torrent_name = function(file)
    local torrent_name = file

    for _, f in ipairs(torrent_namers) do
        torrent_name = torrent_name or f(file)
    end

    return torrent_name or file
end


-- TODO - move configuration out of this file

-- Keep GPG signatures next to the files they authenticate
add_filtering_torrent_namer("%.asc$", function(file)
    return file:sub(1, -5)
end)


-- Bundle the split Vidalia Bundles for Mac into single torrents
add_filtering_torrent_namer("^vidalia-bundles/split-",
    make_gsub_func("%.%d%d%d%.dmgpart$", ".dmg"))
add_filtering_torrent_namer("^vidalia-bundles/split-",
    make_gsub_func("%.%d%d%d%(-%d).dmgpart$", "%1.dmg"))

-- Bundle the split Vidalia Bundles for Windows into single torrents
-- FIXME - do these exist?


-- Bundle the split TBBs and TIMBBs for Windows into single torrents
add_filtering_torrent_namer("^torbrowser/[^/]*split",
    make_gsub_func("/[^/]*$", ""))

-- Bundle the split TBBs for Linux into single torrents
-- FIXME - files not found

-- Bundle the split TBBs for Mac into single torrents
-- FIXME - files not found


-- We don't care about the order in which we enumerate files.
-- I suspect pairs may be a tiny bit faster than ipairs.
for _, file in pairs(files) do
    local torrent_name = compute_torrent_name(file)
    add_file_to_torrent(torrent_name, file)
end


-- Sort the files within each torrent
for _, torrent in pairs(torrents) do
    table.sort(torrent.files)
end


-- List web mirrors of each file
for _, torrent in pairs(torrents) do
    if #(torrent.files) > 1 then
        -- For multi-file torrents, the client concatenates each web-seed
        -- URL with each file name.
        torrent.web_seeds = web_mirror_roots
    else
        io.write("# OOPS - web seeds for single-file torrents not yet implemented\n")
        io.write(string.format("# (torrent name was %q)\n"))
    end
end


-- Output mktorrent commands
-- FIXME - the body of this loop should be a function
-- FIXME FIXME FIXME -- try to escape spaces and shell metacharacters somehow?
for _, torrent in pairs(torrents) do
    local command_parts = {
        "mktorrent",
        "-o",
        torrent.name .. ".torrent",
        "-c",
        "'created by www.torservers.net'",
    }
    
    if #(torrent.trackers) ~= 0 then
        table.insert(command_parts, "-a")
        table.insert(command_parts, table.concat(torrent.trackers, ","))
    end
    
    if #(torrent.web_seeds) ~= 0 then
        table.insert(command_parts, "-w")
        table.insert(command_parts, table.concat(torrent.web_seeds, ","))
    end
    
    io.write(table.concat(command_parts, " "), "\n")
end


